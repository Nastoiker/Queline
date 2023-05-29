

<style>

</style>
<script setup>
 import {storeToRefs} from "pinia";
 import {useUserStore} from "@/js/store/user";
 import MainHome from "@/components/Main/MainHome.vue";
 import CategoryContainer from "@/components/Containers/CategoryContainer.vue";
 import {useVideoStore} from "@/js/store/video";
import VideoContainer from "@/components/Containers/VideoContainer.vue";
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
        <div v-if="categories.length>5">
            <CategoryContainer :categories="categories" />

        </div>
        <VideoContainer :videos="video"/>
        <div>
            Home
            {{user}}
        </div>

    </div>
</template>
