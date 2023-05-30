<template>
    <div>
        <div>
            <Bunner :defaultSrc="user.banner ? '/storage' + user.banner : defaultBanner" @file-updated="uploadBunner"  class="w-full object-cover  h-48" />

            <div class="-mt-20  sm:flex justify-around items-center">
                <div class=" text-center sm:flex sm:text-start">
                    <Avatar  :defaultSrc="user.photo ? '/storage' + user.photo : defaultAvatar"  @input="uploadImage" class="w-48 mx-auto h-48 rounded-full"/>

                    <div class="text-2xl  self-end space-y-5 sm:ml-10 sm:mb-5">
                        <h1 class="mx-auto">{{ user.nickname }}</h1>
                        <h2 class="mx-auto"> {{ user.email }}</h2>
                    </div>
                </div>
                <div class="my-10">
                    <button class="block">
                        <router-link to="/profile/editProfile" name="create_video">Редактировать профиль</router-link>
                    </button>
                    <button class="block">
                        <router-link to="/profile/createVideo" name="create_video">Создать видео</router-link>
                    </button>

                </div>

            </div>
        </div>
        <div class="flex text-sm sm:text-2xl space-x-10 my-20 border-b-2">
            <button
                @click="setActiveTab('own_video')"
                class="isAciveS"
                :class="{ active: activeTab == 'own_video' }"
            >
                <h1>Ваши видео</h1>
            </button>
            <button
                @click="setActiveTab('category')"
                class="isAciveS"
                :class="{ active: activeTab == 'category' }"
            >
                <h1>Категория видео</h1>
            </button>
            <button
                @click="setActiveTab('folows')"
                class="isAciveS"
                :class="{ active: activeTab == 'folows' }"
            >
                <h1>Подписки</h1>
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
            <VideoContainer :videos="video"/>
        </div>
        <div v-if="activeTab === 'about'">
            <div v-for="(value, index) of Object.entries(user)">
                {{ value[0] + ": " + value[1] }}
            </div>
        </div>
    </div>
</template>
<style scope>
.isAciveS {
    padding-bottom: 1rem;
}
.isAciveS.active {
    border-bottom: 5px solid white;
    transition: all 0.2s ease-in-out;
}
</style>
<script>
export default {
    data() {
        return {
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
const videoStore = useVideoStore();
const userStore = useUserStore();
userStore.fetchUser();
const { user } = storeToRefs(userStore);
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

</script>
