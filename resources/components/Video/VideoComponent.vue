<template>
    <div class="w-fit" @mouseover.native="play" >
        <video
            ref="video"
            @mouseover.native="play"
            :poster="props.img"
            width="100"
            height="50"
            class="w-96"
            :controls="isPlaying.value"
            @ended="reset" preload="auto"
            muted="muted"
           >
            <source :src="props.path" type="video/mp4">
        </video>
    </div>
</template>
<script setup>
const props = defineProps({
    title: String,
    description: String,
    id: String,
    category: Object,
    preview: { type: String },
    path: String,
    img: String,
    Author: Object,
    author: Object,
});
import VideoPlayer from "./VideoPlayer.vue";
import {defineProps, ref} from "vue";

const toggle = (e) => {
    isPlaying.value = true;
    console.log(isPlaying.value===true);
}
const hovering = ref(true);
const isPlaying = ref({});



</script>

<script>
import {defineProps} from 'vue';

export default {

    data() {
        return {
            isPlay: false,
        };
    },
    mounted() {
        this.$refs.video.addEventListener('loadeddata', () => {
            console.log('Видео загружено и готово к воспроизведению');
        });
        const video = this.$refs.video;

        video.addEventListener("mouseenter", this.play);
        video.addEventListener("mouseleave", this.stop);
    },
    beforeUnmount() {
        const video = this.$refs.video;
        video.removeEventListener("mouseenter", this.play);
        video.removeEventListener("mouseleave", this.stop);
    },
    methods: {
        play() {
            if(this.isPlay) return;
             else {
                this.$refs.video.currentTime = 0;
                this.isPlay = true;
                this.$refs.video.play();

            }
        },
        stop() {
            if(!this.isPlay) return;
             else {
                this.$refs.video.pause();
                this.isPlay = false;
                this.$refs.video.currentTime = 0;
            }
        },
        reset() {
            if(!this.isPlay) return; else {
                this.$refs.video.currentTime = 0;

            }
        },
    },
};
</script>
