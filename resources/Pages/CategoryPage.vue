<template>

    <VideoContainer :videos="video"/>
    {{value}}
</template>
<script setup>
import {useVideoStore} from "@/js/store/video";
import {storeToRefs} from "pinia";
import {useRoute} from "vue-router";
import VideoContainer from "@/components/Containers/VideoContainer.vue";
const route = useRoute()
const value = route.params.category_Id;
const videoStore = useVideoStore();
const { video } = storeToRefs(videoStore);
videoStore.getVideoByCategory(value);
</script>
