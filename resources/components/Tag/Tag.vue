<template>
    <div class="bg-transparent border rounded-full px-2 mr-2 my-2 text-[14px]">#{{text}}</div>
</template>

<script setup>
const props = defineProps({
    text: {
        type: String,
        default: ''
    }
});
</script>

<style scoped>

</style>
