<template>
    <div class="flex w-auto">
        <div class="w-[20px] h-[20px] mr-2 cursor-pointer">
            <img src="/resources/assets/Vector_dislike.svg" alt="" class="w-fit h-fit object-cover">
        </div>
        <div class="text-[14px]">{{ count }}</div>
    </div>
</template>

<script>
import { defineProps} from 'vue';
const props = defineProps({
    count: {
        type: Number,
        default: 0
    }
})
</script>

<style scoped>

</style>
