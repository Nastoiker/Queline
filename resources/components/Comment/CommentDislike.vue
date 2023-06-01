<template>
    <div class="flex items-center ml-2">
        <div
            class="main-comment-dislike w-[16px] h-[16px] mr-3 cursor-pointer"
            @click="$emit('commentDislike')"
        >
            <img v-if="isGraded" src="/resources/assets/Vector_disliked.svg" alt="">
            <img v-else src="/resources/assets/Vector_dislike.svg" alt="">
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
.main-comment-dislike {
    object-fit: contain;
}
</style>
