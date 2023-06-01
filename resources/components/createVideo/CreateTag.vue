<template>
    <div class="m-2 py-1 px-2 border border-2 rounded-full border-white flex justify-between items-center">
        <div v-text="text">
        </div>
        <div
            class="cross w-[20px] h-[20px] ml-2"
            @click="$emit('deleteTag', props.id)"
        >
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    text: {
        type: String,
        default: ''
    },
    id: {
        type: Number,
        default: -1
    }
});
</script>

<style scoped>
.cross {
    background-image: url("/resources/assets/Group 56_cross.svg");
    background-size: cover;
    background-repeat: no-repeat;
}
</style>
