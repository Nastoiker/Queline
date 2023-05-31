<template>
    <div class="w-fit my-5 ">
        <video
            preload="none"
            ref="video"
            @timeupdate="updateTime"
            :style="{ backgroundImage: 'url(' + props.img + ') ', backgroundSize: 'cover', height: '180px' } "
            class=" video-preview  rounded-md"
            :controls="this.isPlay ?? false"
            @ended="reset"
            muted="muted"
            :src="props.path"
        >
        </video>
    </div>
</template>
<script setup>
import {defineProps, ref} from "vue";
const props = defineProps({
    path: String,
    img: String,
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
            src: '',
            check: false,
        };
    },

    mounted() {

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
            this.currentTime = this.$refs.video.currentTime;
        },
        play() {
            if(!this.isPlay) {
                if(this.check) {
                    this.$refs.video.src = this.src;
                    this.$refs.video.load();
                }
                this.$refs.video.currentTime = 0;
                this.isPlay = true;
                this.$refs.video.play();
            };
        },
        stop() {
            if(this.isPlay) {
                this.isPlay = false;
                this.check = true;
                this.src =  this.$refs.video.src;
                this.$refs.video.src = '';
            };
        },
        reset() {
            if(!this.isPlay) return ; else {
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
.video-preview {
    width: 320px;
    background-size: contain ;
    max-height: 322px;
    background-position: center;
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
