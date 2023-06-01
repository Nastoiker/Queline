

<style>

</style>
<script setup>
 import {storeToRefs} from "pinia";
 import {useUserStore} from "@/js/store/user";
 import MainHome from "@/components/Main/MainHome.vue";
 import CategoryContainer from "@/components/Containers/CategoryContainer.vue";
 import {useVideoStore} from "@/js/store/video";
import VideoContainer from "@/components/Containers/VideoContainer.vue";
 import CategoryArrVideo from "@/components/Containers/CategoryArrVideo.vue";
 import {getFirst} from "@/js/helpler/arr";
 const api = useVideoStore();
 const { categories, video } = storeToRefs(api);
 api.getCategories();
 const userStore = useUserStore();
 const { user } = storeToRefs(userStore);
 userStore.fetchUser();
 api.getAllVideo();
 console.log(categories);
</script>
<template v-if="categories.length>0">
    <div>
        <MainHome />
        <div v-if="categories.length>5" >
            <h1 class="text-4xl ml-4 my-10">Игры</h1>
            <CategoryContainer :categories="categories" />
        </div>
        <div class="my-20">
            <h1 class="text-4xl my-10">Последние видео</h1>
            <VideoContainer :videos="getFirst(video.filter(v => v.is_moderated===1).sort((a, b) => new Date(b.created_at) - new Date(a.created_at)), 10)"/>
        </div>
        <CategoryArrVideo :categories="categories" :videos="video"/>
    </div>
</template>
