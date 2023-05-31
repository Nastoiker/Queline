<template>

    <div class="mx-auto sm:mx-0 my-20"  v-for="c in categories">
        <div  v-if="videos.filter( v => v.category.title === c.title).length>0">
            <h1 class="text-4xl">
                {{ c.title}}
            </h1>
            <VideoContainer   :videos="videos.filter( v => v.category.title === c.title)"/>
        </div>
    </div>

</template>
<script setup>
import VideoData from "@/components/Video/VideoData.vue";
import VideoContainer from "@/components/Containers/VideoContainer.vue";
const props = defineProps({
    categories: Array,
    videos: Array,
})
</script>
