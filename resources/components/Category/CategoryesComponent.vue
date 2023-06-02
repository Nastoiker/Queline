<template>
    <div class="text-center mx-5 min-w-20" @click="router.push(`/category/${category.id}`);" v-bind="$attrs">
<!--        <img :src="category.photo"  class="w-full min-w-10 h-48 rounded-md bg-white" />-->
        <img :src="category.photo ? '/storage' + category.photo : categoryDefault"  class="category__img w-full  object-cover  rounded-md bg-white" />
        <h1 class="text-center">{{ category.title }}</h1>
    </div>
</template>
<script setup>
import router from "@/js/route/index.js";
import categoryDefault from '@/assets/category.jpg'
import {useVideoStore} from "@/js/store/video";
const props = defineProps({
    category: Object,
});
const videoStore = useVideoStore();

</script>
<style scoped>
.category__img {
    min-height: 272px;
    max-height: 272px;
    object-fit: cover;
}
</style>
