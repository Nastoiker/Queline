<template>
    <div class="w-fit my-5 ">
        <video
            preload="none"
            ref="video"
            class=" video-preview  rounded-md"
            :controls="true"
            :poster="props.img"
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
