<template>
    <div class="my-28">
        <CreateVideo />
    </div>
</template>
<script setup>
import {useVideoStore} from "@/js/store/video";
import {defineComponent} from "vue";
import CreateVideo from "@/components/createVideo/CreateVideo.vue";
import {storeToRefs} from "pinia";

const api = useVideoStore();
const { categories } = storeToRefs(api);
const category = api.getCategories();




</script>
