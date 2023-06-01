<template>

    <div v-if="!loaded">
        <div  v-if="videoByCategory.length===0" class="flex justify-center  h-[800px] items-center">
            <h1  class="text-4xl">
                Увы видео по этой категории нету
            </h1>
        </div>

        <div v-else >
            <div class="flex space-x-5 items-center">

                <img :src="categoryDefault"  class="w-32 h-32 object-cover rounded-md bg-white" />

                <h1 class="text-5xl my-20">{{videoByCategory[0].category.title}}</h1>

            </div>
            <VideoContainer :videos="videoByCategory"/>
        </div>

    </div>


</template>
<script setup>
import {useVideoStore} from "@/js/store/video";
import {storeToRefs} from "pinia";
import categoryDefault from '@/assets/category.jpg'

import {useRoute} from "vue-router";
import VideoContainer from "@/components/Containers/VideoContainer.vue";
import {ref} from "vue";
const route = useRoute()
const value = route.params.id;
const videoStore = useVideoStore();
const loaded = ref(true);
const getVideoByCategory = async () => {


    return  await videoStore.getVideoByCategory(value);;

};
const { videoByCategory } = storeToRefs(videoStore);
const asd = getVideoByCategory().then( () => loaded.value=false);
console.log(asd);
</script>
<style scoped>

</style>
