<template>
    <div class="text-start">
        <label :for="label">{{label}}</label>
        <input ref="file" :id="label" class="block" type="text" :="$attrs" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
    </div>
</template>
<script setup>
    defineProps(
        {
            label: {
                type: String,
                default: "",
            },
            modelValue: {
                type: String,
                default: "",
            },
        }
    )
</script>
<style scoped>
    input {
        border-radius: 5px;
        height: 2.5rem;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

</style>
