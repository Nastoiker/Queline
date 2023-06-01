<template>
    <div class="flex mx-auto  flex-wrap sm:gap-[30px]">
        <div class="mx-auto sm:mx-0"  v-for="c of channels" :key="c.id">
            <Channel :channel="c"/>
        </div>
    </div>

</template>
<script setup>
import Channel from "@/components/Channel/Channel.vue";
const props = defineProps({
    channels: Array,
})
</script>
