<script setup lang="ts">
import Plyr from 'plyr';
import 'plyr/dist/plyr.css';
import {onMounted, ref} from "vue";
const video = ref(null);

const onMounted = () => {
    const player = new Plyr(video, {
        // Options
    });
};
video.play();
video.pause();
const constraints = {
    audio: false,
    video: {
        width: { min: 1024, ideal: 1280, max: 1920 },
        height: { min: 576, ideal: 720, max: 1080 },
        facingMode: 'environment',
    },
}
// onMounted(async () => { video.value = await navigator.mediaDevices.getUserMedia(constraints)});
function onTimeupdate() {

}
</script>

<template>
 <div>
    <video @timeupdate="onTimeupdate" :ref="video" @loadeddata="">

    </video>
 </div>
</template>
<style>

</style>
