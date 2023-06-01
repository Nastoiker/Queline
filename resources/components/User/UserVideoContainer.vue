<template>
    <div class="flex mx-auto  flex-wrap sm:gap-[30px]">
        <div class="mx-auto sm:mx-0"  v-for="v in videosarr.filter(video => !deletedVideo.includes(video.hash_id))">
            <VideoData  :video="v"/>
            <button @click="this.handleDelete(v.hash_id)" class="bg-red px-5 py-2 rounded-lg my-2 hover:scale-110 transition-all">Удалить видео</button>
        </div>
        <h1 v-if="videosarr.length===0" class=" mx-auto text-4xl">
            Ничего не найдено
        </h1>
    </div>

</template>
<script>
export default {
    props: {
        videos: Array,
    },
    data() {
        return {
            videosarr: this.videos,
            deletedVideo: [],
        }
    },
    methods: {
        handleDelete(hash_id) {
            this.deletedVideo.push(hash_id);
            this.$emit('delete', hash_id)
        },

    }
}
</script>
<script setup>
import VideoData from "@/components/Video/VideoData.vue";

</script>
