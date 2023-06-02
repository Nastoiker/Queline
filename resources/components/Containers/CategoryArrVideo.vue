<template>
    <div v-if="props.videos.length > 0" >
        <div class="mx-auto sm:mx-0 my-20"  v-for="c in props.categories">
            <div  v-if="props.videos.filter( v => (v.category.title === c.title && v.is_moderated===1 && v.ban_status_id===1)).length>0">
                <div class="flex ml-2 md:ml-0 space-x-5 items-center">
                    <img :src="c.photo ? '/storage' + c.photo : categoryDefault" alt="" class="w-32 h-32 object-cover rounded-md bg-white" />
                    <h1 class="text-4xl">
                        {{ c.title}}
                    </h1>
                </div>
                <VideoContainer :videos="props.videos.filter( v => v.category.title === c.title && v.is_moderated===1 && v.ban_status_id===1)"/>
            </div>
        </div>
    </div>


</template>
<script setup>
import VideoData from "@/components/Video/VideoData.vue";
import categoryDefault from '@/assets/category.jpg'
import VideoContainer from "@/components/Containers/VideoContainer.vue";
const props = defineProps({
    categories: Array,
    videos: Array,
})
</script>
