<template>
    <div class="flex w-auto"  @click="handleClick">
        <div class="w-[20px] h-[20px] mr-2 cursor-pointer">
            <img v-if="isGraded" src="/resources/assets/Vector_disliked.svg" alt="" class="w-fit h-fit object-cover">
            <img v-else src="/resources/assets/Vector_dislike.svg" alt="" class="w-fit h-fit object-cover">
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
});

const emits = defineEmits([
    'dislikeVideo', 'deleteVideoGrade'
]);

const handleClick = () => {
    if (props.isGraded) {
        emits('deleteVideoGrade');
        return ;
    }
    emits('dislikeVideo')
}

</script>

<style scoped>

</style>
