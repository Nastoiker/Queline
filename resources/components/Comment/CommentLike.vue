<template>
    <div class="flex items-center mr-2">
        <div
            class="main-comment-like w-[16px] h-[16px] mr-3 cursor-pointer"
            @click="$emit('commentLike')"
        ></div>
        <div>{{count}}</div>
    </div>
</template>

<script setup>
const props = defineProps({
    count: {
        type: Number,
        default: 0
    }
});
</script>

<style scoped>
.main-comment-like {
    background-image: url("/resources/assets/Vectorlike.svg");
    background-size: contain;
    background-repeat: no-repeat;
}
</style>
