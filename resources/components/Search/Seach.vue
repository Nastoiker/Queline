<script setup>
import {ref} from "vue";
import {useVideoStore} from "@/js/store/video";

const props = defineProps({
    label: String,
});
const video = useVideoStore();
const find = ref("");
function findVideo(e) {
    e.preventDefault();
};
</script>
<template>
    <form @submit="findVideo" class="flex">
        <input  v-model="find"  :="$attrs"  class="search__icon__input indent-16 bg-white"  @input="$emit('update:modelValue', $event.target.value)"/>
    </form>

</template>
<style scoped>
 .search__icon__input {
        background: url("../../assets/Search.svg") no-repeat;
     padding-right: 1rem;
     padding-bottom: 0.2rem;
     padding-top: 0.2rem;
     max-width: 20rem;
     width: 100%;
     background-color: white;

     background-position: right;
     background-origin: content-box;
    border-radius: 1rem;
 }

</style>

