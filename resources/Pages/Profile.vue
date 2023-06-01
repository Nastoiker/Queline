<template>
    <div>
        <div>
            <Bunner :defaultSrc="user.banner ? '/storage' + user.banner : defaultBanner" @file-updated="uploadBunner"  class="w-full object-cover  h-48" />

            <div class="-mt-20  sm:flex justify-around ">
                <div class=" text-center sm:flex sm:text-start">
                    <Avatar  :defaultSrc="user.photo ? '/storage' + user.photo : defaultAvatar"  @input="uploadImage" class="w-48 mx-auto h-48 rounded-full"/>

                    <div class="text-2xl  self-end space-y-5 sm:ml-10 sm:mb-5">
                        <h1 class="mx-auto">{{ user.nickname }}</h1>
                        <h2 class="mx-auto"> {{ user.email }}</h2>
                    </div>
                </div>
                <div class="mt-20 space-y-2">
                    <button v-if="user.role_id===1" class=" text-white block rounded-full bg-red py-2 px-10">
                        <router-link to="/admin" name="admin">Войти в админку</router-link>
                    </button>
                    <button class=" text-white block bg-green py-2 px-10 rounded-full">
                        <router-link to="/profile/createVideo" name="create_video">Создать видео</router-link>
                    </button>

                </div>

            </div>
        </div>
        <div class="lg:px-48 flex text-sm sm:text-2xl space-x-10 my-20 border-b-2 ">
            <button
                @click="setActiveTab('own_video')"
                class="isAciveS"
                :class="{ active: activeTab == 'own_video' }"
            >
                <h1>Ваши видео</h1>
            </button>

            <button
                @click="setActiveTab('about')"
                class="isAciveS"
                :class="{ active: activeTab == 'about' }"
            >
                <h1>О канале</h1>
            </button>
        </div>
        <div v-if="activeTab === 'own_video' && !loaded">
            <UserVideoContainer @delete="handleDelete" :videos="video"/>
        </div>

        <div v-if="activeTab === 'about'" class="flex space-x-20">
            <div>
                <div >
                    <h1 class="block text-xl">Описание:</h1>
                    <div v-if="!editMode"  @click="editMode = true">{{ user.description ?? 'Добавить описание'}}</div>
                </div>

                <textarea class="p-5 rounded-md" placeholder="Описание" @input="" v-if="editMode" v-model="description" @blur="editMode = false"></textarea>

            </div>
            <div><h1 class="text-xl">Дата создания:</h1> <h1>{{DateNumber(user.created_at)}}</h1></div>
        </div>
    </div>
</template>
<style scope>
.isAciveS {
    padding-bottom: 1rem;
}
.isAciveS.active {
    transition: all 0.2s ease-in-out;
    @apply  border-b-4 ;
}
</style>
<script>
export default {
    data() {
        return {
            editMode: false,
            description: "Описание",
            activeTab: "own_video",
        };
    },
    methods: {
        setActiveTab(tab) {
            this.activeTab = tab;
        },
    },
};
</script>
<script setup>
import defaultBanner from "@/assets/banner.jpg";
import { computed, ref } from "vue";
import defaultAvatar from "@/assets/user.jpg";
import { useUserStore } from "../js/store/user";
import Avatar from "@/components/AvatarComponent/Avatar.vue";
import Bunner from '@/components/Bunner/Bunner.vue'
import { storeToRefs } from "pinia";

import VideoComponent from "@/components/Video/VideoComponent.vue";
import { useVideoStore } from "@/js/store/video";
import VideoContainer from "@/components/Containers/VideoContainer.vue";
import {DateNumber} from "../js/helpler/date";
import ChannelsContainer from "@/components/Containers/ChannelsContainer.vue";
import UserVideoContainer from "@/components/User/UserVideoContainer.vue";
const videoStore = useVideoStore();
const userStore = useUserStore();
userStore.fetchUser();
const { user, loading } = storeToRefs(userStore);
const { video, loaded } = storeToRefs(videoStore);
const isActive = ref("");
videoStore.getVideoUser(localStorage.getItem('nickname'));

const uploadImage = (e) => {
    AvatarFile.value = e;
    userStore.editAvatar({
        photo: AvatarFile.value,
        _method: 'PUT',
    })

}
const AvatarFile = ref({});
const BunnerFile = ref({});
function HandleError(error){
    errorBunner.value = error;
}
const uploadBunner = (e) => {
    BunnerFile.value = e;
    userStore.editBanner({
        banner: AvatarFile.value,
        _method: 'PUT',
    });
}
const handleDelete = (hash_id) => {
    userStore.deleteVideo(hash_id);
}
</script>
