<template>

    <div v-if="props.videos" class="mx-auto sm:mx-0 my-20"  v-for="c in props.categories">
        <div  v-if="props.videos.filter( v => v.category.title === c.title).length>0">
            <h1 class="text-4xl">
                {{ c.title}}
            </h1>
            <VideoContainer   :videos="props.videos.filter( v => v.category.title === c.title)"/>
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
