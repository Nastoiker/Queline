<template>
    <div>
        <textarea
            cols="30"
            rows="10"
            @input="$emit('update:modelValue', $event.target.value)"
            :placeholder="props.placeholder"
            class="border-white w-full border-2 rounded bg-transparent mt-3 p-2"
        ></textarea>
    </div>
</template>

<script setup>
const props = defineProps({
    modelValue: {
        type: String,
        default: "",
    },
    placeholder: {
        type: String,
        default: ''
    }
});
</script>

<style scoped>

</style>
