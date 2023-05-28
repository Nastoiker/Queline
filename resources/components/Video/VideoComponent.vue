<template>
    <div class="w-fit  my-5 " @mouseover.native="play" >
        <video
            ref="video"
            @timeupdate="updateTime"
            @mouseover.native="play"
            :poster="props.img"
            width="100"
            height="50"
            class="w-96 "
            :controls="isPlaying.value"
            @ended="reset" preload="auto"
            muted="muted"
           >
            <source :src="props.path" type="video/mp4">
        </video>
        <div v-if="currentTime>0" className="progress-bar-container">
            <progress className="progress-bar absolute z-10" :max="duration" :value="currentTime"></progress>
        </div>
    </div>
</template>
<script setup>
import {defineProps, ref} from "vue";
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
            currentTime: 0,
            duration: 20,
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
        updateTime() {
            this.currentTime =this.$refs.video.currentTime ;
        },
        play() {
            if(this.isPlay) return;
             else {
                this.$refs.video.currentTime = 0;
                this.isPlay = true;
                this.$refs.video.play();
                this.duration = this.$refs.video.duration;
            }
        },
        stop() {
            if(!this.isPlay) return;
             else {
                this.$refs.video.pause();
                this.isPlay = false;
                this.$refs.video.currentTime = -1;
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
<style scoped>
.progress-bar-container {
    position: relative;
}

.progress-bar-text {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    font-weight: bold;
}

.progress-bar {
    appearance: none;
    -webkit-appearance: none;
    width: 100%;
    height: 3px;
    background-color: #f2f2f2;
    overflow: hidden;
}

.progress-bar::-webkit-progress-bar {
    background-color: #f2f2f2;
    border-radius: 5px;
}

.progress-bar::-webkit-progress-value {
    background-color: #4caf50;
    border-radius: 5px;
    transition: all 0.5s ease;
}

.progress-bar[value="0"]::-webkit-progress-value {
    background-color: #f44336;
}

.progress-bar[value="50"]::-webkit-progress-value {
    background-color: #ffc107;
}

.progress-bar[value="100"]::-webkit-progress-value {
    background-color: #4caf50;
}
</style>
