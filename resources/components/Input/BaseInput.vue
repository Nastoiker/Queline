<template>
    <div class="text-start">
        <label :for="label">{{ label }}</label>
        <input
            ref="file"
            :id="label"
            class="w-full text-white p-2 border-black border-b-2 dark:border-white bg-transparent"
            type="text" :="$attrs" :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
        >
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
    border: none;
    border-bottom: #181818 2px solid;
    background: transparent;
    outline: none;
}

input::placeholder,
input::-moz-placeholder,
input:-moz-placeholder
{
    font-size: 1rem;
    font-weight: bold;
    margin: 5px;
}

</style>
