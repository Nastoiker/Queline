<template>
    <div class="flex mx-auto  flex-wrap sm:gap-[30px]">
        <div class="mx-auto w-[500px] sm:mx-0"  v-for="v in channels">
            <Channel  :channel="v"/>

        </div>
        <h1 v-if="channels.length===0" class="text-4xl">
            Ничего не найдено
        </h1>
    </div>

</template>
<script setup>
import Channel from '@/components/Channel/Channel.vue'
import {useAdminStore} from "@/js/store/admin";
const props = defineProps({
    channels: Array,
});
const adminStore = useAdminStore();

</script>
