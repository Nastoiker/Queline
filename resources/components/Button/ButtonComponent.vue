<script setup lang="ts">

const props = defineProps({
    leftIcon: Object,
    className: String,
});
</script>
<template>
    <button class=" text- white bg-gray-700">

        <slot />
    </button>
</template>
<style>
 button {
     background-color: #0b2e13;

 }
</style>
