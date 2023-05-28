

<style>

</style>
<script setup>
 import {storeToRefs} from "pinia";
 import {useUserStore} from "@/js/store/user";
 import MainHome from "@/components/Main/MainHome.vue";
 import CategoryContainer from "@/components/Containers/CategoryContainer.vue";
 import {useVideoStore} from "@/js/store/video";
 import VideoComponent from "@/components/Video/VideoComponent.vue";
import video from '@/assets/video.mp4';
import videoImg from '@/assets/preview.jpg';
 // export default {
 //     components: {CategoryContainer}
 // }
 const api = useVideoStore();
 const { categories } = storeToRefs(api);
 api.getCategories();
 const userStore = useUserStore();
 const { user } = storeToRefs(userStore);
 userStore.fetchUser();

 console.log(categories);
</script>
<template v-if="categories.length>0">
    <div>
        <MainHome />
        <div v-if="categories.length>5">
            <CategoryContainer :categories="categories" />

        </div>
        <VideoComponent
            class="w-fit"
            :img="videoImg"
            :path="video"
        />
        <div>
            Home
            {{user}}
        </div>

    </div>
</template>
