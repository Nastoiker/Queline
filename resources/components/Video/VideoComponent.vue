<template>
    <div>

        <VideoPlayer  />
    </div>
</template>
<script setup>
    import VideoPlayer from "./VideoPlayer.vue";

    const props = defineProps({
        name: String,
        description: String,
        id: String,
        file: File,
        watchers: String,
        author: Object,
    });
</script>
