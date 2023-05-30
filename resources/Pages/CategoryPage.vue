<template>
    <div class="flex space-x-5 items-center">
        <img :src="categoryDefault"  class="w-32 h-32 object-cover rounded-md bg-white" />
        <h1 class="text-5xl my-20">{{videoByCategory[0].category.title}}</h1>
    </div>

<VideoContainer :videos="videoByCategory.filter((v) => v.category.id == value)"/>

</template>
<script setup>
import {useVideoStore} from "@/js/store/video";
import {storeToRefs} from "pinia";
import categoryDefault from '@/assets/category.jpg'

import {useRoute} from "vue-router";
import VideoContainer from "@/components/Containers/VideoContainer.vue";
const route = useRoute()
const value = route.params.category_Id;
const videoStore = useVideoStore();
videoStore.getVideoByCategory(value);
const { videoByCategory } = storeToRefs(videoStore);
</script>
