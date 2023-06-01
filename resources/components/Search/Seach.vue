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
    router.push(`../founded/${find.value}`);
}
</script>
<template>
    <form @submit.prevent="findVideo" class="flex ml-4">
        <input
            v-model="find"
            :="$attrs"
            type="search"
            class="search__icon__input  indent-8 sm:w-96 h-[34px]  text-black "
            @input="$emit('update:modelValue', $event.target.value)"
        />
    </form>
</template>
<style scoped>
input:focus {
    transition: all 2s ease-in-out;
    border: 2px solid;
}
.search__icon__input {
    background: url("../../assets/Search.svg") no-repeat;
    background-size: 15px;
    padding-right: 1rem;
    padding-bottom: 0.4rem;
    padding-top: 0.4rem;
    max-width: 20rem;
    background-color: #E9E8ED;
    border: 2px solid;
    background-position: right;
    background-origin: content-box;
    border-radius: 1rem;
}
@media screen and (max-width: 50rem) {
    .search__icon__input {
        background: url("../../assets/Search.svg") no-repeat;
        padding-right: 1rem;
        padding-bottom: 0.2rem;
        padding-top: 0.2rem;
        margin: 2 auto;
        width: 100%;
        max-width: 20rem;
        background-color: #E9E8ED;
        border: 0;
        background-position: right;
        background-origin: content-box;
        border-radius: 1rem;
    }
}
</style>
