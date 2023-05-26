<template>
    <div>
        <div>
            <img
                class="w-full h-48 object-cover"
                :src="user.banner ? user.banner : defaultBanner"
                alt=""
            />
            <div class="-mt-20 flex justify-around items-center">
                <div class="  sm:flex text-start">
                    <img
                        class="w-48 mx-auto h-48 rounded-full"
                        :src="user.photo ? user.photo : defaultAvatar"
                        alt=""
                    />
                    <div class="text-2xl  self-end space-y-5 sm:ml-10 sm:mb-5">
                        <h1 class="mx-auto">{{ user.nickname }}</h1>
                        <h2 class="mx-auto"> {{ user.email }}</h2>
                    </div>
                </div>
                <button>
                    <router-link to="/profile/editProfile" name="create_video"
                        >Редактировать профиль</router-link
                    >
                </button>
            </div>
        </div>
        <div class="flex text-2xl space-x-10 my-20 border-b-2">
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

        <div v-for="video of user.video">
            <div>
                {{ video.title }}
                <VideoComponent
                    :img="video.preview"
                    :path="'/storage' + video.path"
                />
                <!--                        <video width="400" height="300" controls="controls"  :src="'../../storage' + video.path"></video>-->
            </div>
        </div>
        <div v-if="activeTab === 'about'">
            <div v-for="(value, index) of Object.entries(user)">
                {{ value[0] + ": " + value[1] }}
            </div>
        </div>
        <router-link to="/profile/createVideo" name="create_video"
            >Создать видео</router-link
        >
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
import { storeToRefs } from "pinia";
import Banner from "@/assets/banner.jpg";
import VideoComponent from "@/components/Video/VideoComponent.vue";
import { useVideoStore } from "@/js/store/video";
const videoStore = useVideoStore();
const userStore = useUserStore();
const userInfo = userStore.fetchUser();
userStore.fetchUser();
userStore.getVideoUser();
const { user } = storeToRefs(userStore);
const isActive = ref("");

console.log(user);
</script>
