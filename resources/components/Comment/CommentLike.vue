<template>
    <div class="flex items-center mr-2">
        <div
            class="main-comment-like w-[16px] h-[16px] mr-3 cursor-pointer"
            @click="$emit('commentLike')"
        >
            <img v-if="isGraded" src="/resources/assets/Vector_liked.svg" alt="">
            <img v-else src="/resources/assets/Vectorlike.svg" alt="">
        </div>
        <div>{{ count }}</div>
    </div>
</template>

<script setup>
const props = defineProps({
    count: {
        type: Number,
        default: 0
    },
    isGraded: {
        type: Boolean,
        default: false
    }
});
</script>

<style scoped>
.main-comment-like {
    object-fit: contain;
}
</style>
