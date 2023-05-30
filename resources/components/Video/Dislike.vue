<template>
    <div class="flex w-auto"  @click="$emit('dislike')">
        <div class="w-[20px] h-[20px] mr-2 cursor-pointer">
            <img src="/resources/assets/Vector_dislike.svg" alt="" class="w-fit h-fit object-cover">
        </div>
        <div class="text-[14px]">{{ count }}</div>
    </div>
</template>

<script setup>
const props = defineProps({
    count: {
        type: Number,
        default: 0,
    },
    isGraded: {
        type: Boolean,
        default: false
    }
})
</script>

<style scoped>

</style>
