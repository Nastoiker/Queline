<template>
    <div class="w-fit">
        <div class="w-[125px] h-[125px] bg-gray rounded-full overflow-hidden">
            <img :src="'/storage' + photo" alt="" class="w-fit h-fit object-cover object-center">
        </div>
        <div class="text-center my-2 text-[24px]">{{nickname}}</div>
        <div class="text-[14px] text-center">{{subscribersCount}} подписчиков</div>
        <button class="block w-fit rounded-full bg-gray py-2 px-2 mt-3">
            <span v-if="isSubscribed">Вы подписаны</span>
            <span v-else>Подписаться</span>
        </button>
    </div>
</template>

<script setup>
const props = defineProps({
    photo: {
        type: String,
        default: ''
    },
    nickname: {
        type: String,
        default: ''
    },
    subscribersCount: {
        type: Number,
        default: 0
    },
    isSubscribed: {
        type: Boolean,
        default: false
    }
});
</script>

<style scoped>

</style>
