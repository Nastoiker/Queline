<template>
    <div>
        <div>
            <img
                class="w-full h-48 object-cover"
                :src="user.banner ? user.banner : defaultBanner"
                alt=""
            />
            <div class="-mt-20 flex justify-around items-center">
                <div class="flex">
                    <img
                        class="w-48 h-48 rounded-full"
                        :src="user.photo ? user.photo : defaultAvatar"
                        alt=""
                    />
                    <div class="self-end space-y-5 ml-10 mb-5">
                        <h1>{{ user.nickname }}</h1>
                        <h2>{{ user.email }}</h2>
                    </div>
                </div>
                <button>
                    <router-link to="/profile/editProfile" name="create_video"
                        >Редактировать профиль</router-link
                    >
                </button>
            </div>
        </div>
        <div class="flex border border-b-2">
            <button @click="isActive = 'own_video'">
                <h1 :class="{ isAciveS: isActive.value === 'own_video' }">
                    Ваши видео
                </h1></button
            ><button>
                <h1>Категория видео</h1></button
            ><button>
                <h1>Подписки</h1></button
            ><button>
                <h1>О каналае</h1>
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
        <router-link to="/profile/createVideo" name="create_video"
            >Создать видео</router-link
        >
    </div>
</template>
<style scope>
.isAciveS {
    color: white;
    border-bottom: 5px solid black;
}
</style>
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
