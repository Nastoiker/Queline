<template>
    <div class="w-fit my-5 ">
        <video
            preload="none"
            ref="video"
            class=" video-preview object-cover  rounded-md"
            :controls="true"
            :poster="props.img"
            muted="muted"
            :src="props.path"
        >
        </video>
    </div>
</template>
<script setup>
import {defineProps} from "vue";
const props = defineProps({
    path: String,
    img: String,
});






</script>

<script>
import {defineProps} from 'vue';


</script>
<style scoped>

.video-preview {
    width: 320px;
    background-size: contain ;
    max-height: 322px;
    background-position: center;
}

</style>
