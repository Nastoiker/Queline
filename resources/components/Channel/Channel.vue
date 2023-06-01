<template>
    <div @click="router.push(`@${channel.nickname}`)" class="flex space-x-5 items-center">
        <img :src="channel.photo ? '/storage' + channel.photo : defaultAvatar" class="rounded-full object-cover w-28 h-28" alt="">
        <div>
            <h1 class="text-xl">
                {{channel.nickname}}
            </h1>
        </div>
    </div>
</template>
<script setup>
import defaultAvatar from "@/assets/user.jpg";
import router from "@/js/route";

const props = defineProps({
    isFollow: Boolean,
    channel: Object,
})
</script>
