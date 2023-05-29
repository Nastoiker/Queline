<template>
    <div class="flex mx-auto  flex-wrap sm:gap-[30px]">
        <div class="mx-auto sm:mx-0"  v-for="v of videos" :key="v.hash_id">
            <VideoData  :video="v"/>
        </div>
    </div>

</template>
<script setup>
import VideoData from "@/components/Video/VideoData.vue";
const props = defineProps({
    videos: Array,
})
</script>
