<template>
    <div class="flex mx-auto  flex-wrap sm:gap-[30px]">
        <div class="mx-auto sm:mx-0"  v-for="v in videos.filter(s => s.is_moderated===1)" :key="v.hash_id">
            <VideoData  :video="v"/>
        </div>
        <h1 v-if="videos.filter(v => v.is_moderated===1).length===0 && !show" class=" mx-auto text-4xl">
            Ничего не найдено
        </h1>
    </div>

</template>
<script setup>
import VideoData from "@/components/Video/VideoData.vue";
const props = defineProps({
    videos: Array,
    show: Boolean,
})
</script>
