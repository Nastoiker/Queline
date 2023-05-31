<template>
    <div class="flex space-x-5 items-center">
        <img :src="categoryDefault"  class="w-32 h-32 object-cover rounded-md bg-white" alt=""/>
        <h1 class="text-5xl my-20">{{categories[value].title}}</h1>
    </div>

<!--<VideoContainer :videos="videoByCategory.filter((v) => v.category.id === +value)"/>-->

</template>
<script setup>
import {useVideoStore} from "@/js/store/video";
import {storeToRefs} from "pinia";
import categoryDefault from '@/assets/category.jpg'

import {useRoute} from "vue-router";
import VideoContainer from "@/components/Containers/VideoContainer.vue";
const route = useRoute()
const value = route.params.id;
const videoStore = useVideoStore();
videoStore.getVideoByCategory(value);
const { videoByCategory } = storeToRefs(videoStore);
await videoStore.getCategories();
const categories = videoStore.returnCategories;

console.log(categories)
</script>
<style scoped>

</style>
