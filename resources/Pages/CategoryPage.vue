<template>

</template>
<script setup>
import {useVideoStore} from "@/js/store/video";
import {storeToRefs} from "pinia";

const categoryId = this.$route.params.category;
const videoStore = useVideoStore();
const { video } = storeToRefs(videoStore);
videoStore.getVideoByCategory(categoryId);
</script>
