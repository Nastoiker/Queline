<template>
    <div class="w-[320px]">
        <VideoComponent
            @click="router.push(`/video/${hash}`)"
            :img="'/storage' + video.preview"
            :path="'/storage'+ video.path"
        />
        <div class="flex">
            <div>
                <img src="" class="rounded-full object-cover" alt="">
            </div>
            <div class=" break-words w-[246px]">
                <h1>{{video.title}}</h1>
<!--                <p>{{video.author.nickname}}</p>-->
                <div>
                    <span>{{formatDate(new Date(video.created_at))}}</span>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import router from "@/js/route/index.js";

import VideoComponent from "@/components/Video/VideoComponent.vue";
import formatDate from "@/js/helpler/date";

const props = defineProps({
    video: Object,
});
</script>
