<template>
    <div>
        <h1>Создание видео</h1>
        <CreateVideo />
    </div>
</template>
<script setup>
import {useVideoStore} from "@/js/store/video";

const api = useVideoStore();
const { categories } = storeToRefs(api);
const category = api.getCategories();

import {defineComponent} from "vue";
import CreateVideo from "@/components/createVideo/CreateVideo.vue";
import {storeToRefs} from "pinia";


</script>
