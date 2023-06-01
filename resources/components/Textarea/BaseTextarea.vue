<template>
    <div>
        <textarea
            cols="30"
            rows="10"
            @input="$emit('update:modelValue', $event.target.value)"
        ></textarea>
    </div>
</template>

<script setup>
const props = defineProps({

});
</script>

<style scoped>

</style>
