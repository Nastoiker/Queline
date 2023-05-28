<template>
    <div ref="video" @click="play">
        <video
            :poster="props.img"
            width="400"
            height="300"
            :controls="isPlaying.value===true"
            @ended="reset" preload="auto"
            @mouseover="play" @mouseleave="stop" ref="video"
        >
            <source :src="videoUrl" type="video/mp4">
        </video>
        <!--        <VideoPlayer  />-->
    </div>
</template>
<script setup>
import VideoPlayer from "./VideoPlayer.vue";
import {ref} from "vue";
const toggle = (e) => {
    isPlaying.value = true;
    console.log(isPlaying.value===true);
}
const hovering = ref(true);
const isPlaying = ref({});


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
</script>

<script>
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
export default {

    data(props) {
        return {
            videoUrl: props.path,
        };
    },
    mounted() {
        this.$refs.video.pause(); // Остановите видео перед его запуском
        this.$refs.video.addEventListener('loadeddata', () => {
            console.log('Видео загружено и готово к воспроизведению');
        });
    },
    methods: {
        play() {
            this.$refs.video.play();
        },
        stop() {
            this.$refs.video.pause();
            this.$refs.video.currentTime = 0;
        },
        reset() {
            this.$refs.video.currentTime = 0;
        },
    },
};
</script>
