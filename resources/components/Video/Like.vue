<template>
    <div class="flex w-auto" @click="handleClick">
        <div class="w-[20px] h-[20px] mr-2 cursor-pointer">
            <img v-if="isGraded" src="/resources/assets/Vector_liked.svg" alt="" class="w-fit h-fit object-contain">
            <img v-else src="/resources/assets/Vectorlike.svg" alt="" class="w-fit h-fit object-contain">
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
    'likeVideo', 'deleteVideoGrade'
]);

const handleClick = () => {
    if (props.isGraded) {
        emits('deleteVideoGrade');
        return ;
    }
    emits('likeVideo')
}

</script>

<style scoped>

</style>
