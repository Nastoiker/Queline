<template>
<div>
    <div>
        <div>
            <img :src="channel.banner ? '/storage' + channel.banner : defaultBanner"   class="w-full object-cover  h-48" />

            <div class="-mt-20  sm:flex justify-around items-center">
                <div class=" text-center sm:flex sm:text-start">
                    <img  :src="channel.photo ? '/storage' + channel.photo : defaultAvatar"  class="w-48 mx-auto h-48 object-cover rounded-full"/>

                    <div class="text-2xl  self-end space-y-5 sm:ml-10 sm:mb-5">
                        <h1 class="mx-auto">{{ channel.nickname }}</h1>
                        <h2 class="mx-auto"> {{ channel.email }}</h2>
                    </div>
                </div>
                <div class="my-10">
                    <button class="block">
                        подписаться
                    </button>


                </div>

            </div>
        </div>
        <div class="flex lg:px-48 text-sm sm:text-2xl space-x-10 my-20 border-b-2 ">
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
        <div v-if="activeTab === 'folows'">
            <div v-for="(value, index) of subs" :key="index">
                {{ value }}
            </div>
        </div>
        <div v-if="activeTab === 'about'">
            <div>
                <div >
                    <h1 class="block text-xl">Описание:</h1>
                    <p>{{ user.description ?? 'Автор ничего о себе не написал('}}</div>
                </div>
            </div>
            <div><h1 class="text-xl">Дата создания:</h1> <h1>{{DateNumber(channel.created_at)}}</h1></div>
        </div>
    </div>
</div>

</template>
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
import {useVideoStore} from "@/js/store/video";
import {storeToRefs} from "pinia";
import defaultBanner from "@/assets/banner.jpg";
import { computed, ref } from "vue";
import defaultAvatar from "@/assets/user.jpg";
import {useRoute} from "vue-router";
import VideoContainer from "@/components/Containers/VideoContainer.vue";
import {useChannelStore} from "@/js/store/channel";
import {useUserStore} from "@/js/store/user";
import router from "@/js/route";
import {DateNumber} from "../js/helpler/date";
const route = useRoute();
const value = route.params.nickname;
const videoStore = useVideoStore();
const channelStore = useChannelStore();
channelStore.getChannel(value);
channelStore.getSubs(value);
const userStore = useUserStore();
const { user } = storeToRefs(userStore);
if(value===user.nickname) {
    router.push('/profile');
}
const { video, loaded } = storeToRefs(videoStore);
videoStore.getVideoUser(value);
const { channel, subs } = storeToRefs(channelStore);
</script>
