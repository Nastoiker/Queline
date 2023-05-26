<script setup>
import { ref } from "vue";
import { useVideoStore } from "@/js/store/video";
import router from "@/js/route/index.js";
const props = defineProps({
    label: String,
});
const video = useVideoStore();
const find = ref("");
function findVideo() {
    router.push(`founded/${find.value}`);
}
</script>
<template>
    <form @submit.prevent="findVideo" class="flex">
        <input
            v-model="find"
            :="$attrs"
            class="search__icon__input indent-8"
            @input="$emit('update:modelValue', $event.target.value)"
        />
    </form>
</template>
<style scoped>
input:focus {
    width: 600px;
    transition: all 2s ease-in-out;
}
.search__icon__input {
    background: url("../../assets/Search.svg") no-repeat;
    padding-right: 1rem;
    padding-bottom: 0.2rem;
    padding-top: 0.2rem;
    max-width: 20rem;
    width: 100%;
    background-color: #E9E8ED;
    border: 2px solid;
    background-position: right;
    background-origin: content-box;
    border-radius: 1rem;
}
</style>
