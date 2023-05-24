<template>
    <div>
        <div>
            <img :src="user.banner" alt="" />
            <div>
                <div>
                    <img :src="user.photo" alt="">
                    <div>
                        <h2>{{user.nickname}}</h2>
                    </div>
                </div>
                <button></button>
                <div  v-for="video of user.video">
                    <div>
                        {{video.title}}
                        <VideoComponent :img="video.preview" :path="'/storage'+video.path" />
<!--                        <video width="400" height="300" controls="controls"  :src="'../../storage' + video.path"></video>-->
                    </div>
                    </div   >
                <router-link to="/profile/createVideo" name="create_video" >Создать видео</router-link>
            </div>
        </div>
    </div>
</template>

<script setup>
    import {useUserStore} from "../js/store/user";
    import {storeToRefs} from "pinia";
    import VideoComponent from '@/components/Video/VideoComponent.vue';
    import {useVideoStore} from "@/js/store/video";
    const videoStore =  useVideoStore();
    const userStore = useUserStore();
    const userInfo = userStore.fetchUser();
    userStore.fetchUser();
    userStore.getVideoUser()
    const { user } = storeToRefs(userStore);

    console.log(user);
</script>
