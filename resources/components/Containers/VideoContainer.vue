<template>
    <div class="grid  grid-cols-5">
        <div  v-for="v of videos" :key="v.hash_id">
            <VideoData :video="v"/>
        </div>
    </div>

</template>
<script setup>
import VideoData from "@/components/Video/VideoData.vue";
const props = defineProps({
    videos: Array,
})
</script>
