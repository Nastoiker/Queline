<template>
    <div>
        <video
            width="400"
            height="300"
            controls="controls"
            :src="'/storage' + props.path"
        ></video>
        <img width="400" height="300" :src="'/storage' + props.img" />
        <!--        <VideoPlayer  />-->
    </div>
</template>
<script setup>
import VideoPlayer from "./VideoPlayer.vue";
const props = defineProps({
    title: String,
    description: String,
    id: String,
    category: Object,
    preview: { type: String },
    path: String,
    img: String,
    Author: Object,
    author: Object,
});
</script>
<script></script>
