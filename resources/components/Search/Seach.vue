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
    <form @submit="findVideo">
        <label>{{label}}</label>
        <input  v-model="find"  :="$attrs"  class="search__icon__input"  @input="$emit('update:modelValue', $event.target.value)"/>
    </form>

</template>
<style scoped>
 .search__icon__input {
        background: url("../../assets/Search.svg") no-repeat;
    }
</style>

