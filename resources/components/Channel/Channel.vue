<template>
    <div class="flex space-x-5">
        <img :src="channel.photo ? '/storage' + channel.photo : defaultAvatar" class="rounded-full w-28 h-28" alt="">
        <div>
            <h1>
                {{channel.nickname}}
            </h1>
            <p>{{channel.subscribers}} Подписчиков</p>
            <button>{{ isFollow ? 'Отписаться' : 'Подписаться'}}</button>
        </div>
    </div>
</template>
<script setup>
import defaultAvatar from "@/assets/user.jpg";
const props = defineProps({
    isFollow: Boolean,
    channel: Object,
})
</script>
