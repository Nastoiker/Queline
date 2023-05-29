<template>
    <div class="w-[320px]">
        <VideoComponent
            @click="router.push(`/video/${hash}`)"
            :img="'/storage' + video.preview"
            :path="'/storage'+ video.path"
        />
        <div class="flex space-x-5">
            <div>
                <img :src="video.author.photo ? '/storage' + video.author.photo : defaultAvatar"  class="rounded-full object-cover w-[49px] h-[49px]" alt="">
            </div>
            <div class=" break-words w-[246px]">
                <h1>{{video.title}}</h1>
                <div>
                    <h1>{{video.author.nickname}}</h1>
                    <div>
                        <div>

                        </div>
                        <span>{{formatDate(video.created_at)}}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script setup>
import router from "@/js/route/index.js";

import VideoComponent from "@/components/Video/VideoComponent.vue";
import formatDate from "@/js/helpler/date";
import defaultAvatar from "@/assets/user.jpg";

const props = defineProps({
    video: Object,
});
</script>
