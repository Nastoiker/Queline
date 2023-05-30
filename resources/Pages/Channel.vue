<template>
<div>

</div>

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
