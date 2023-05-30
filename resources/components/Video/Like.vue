<template>
    <div class="flex w-auto" @click="">
        <div class="w-[20px] h-[20px] mr-2 cursor-pointer">
            <img src="/resources/assets/Vectorlike.svg" alt="" class="w-fit h-fit object-cover">
        </div>
        <div class="text-[14px]">{{ count }}</div>
    </div>
</template>

<script>
const props = defineProps({
    count: {
        type: Number,
        default: 0
    }
})

export default {
    methods: {
        setLike() {

        }
    }
}
</script>

<style scoped>

</style>
