<script setup>
const props = defineProps({
    id: String,
    label: String,
    placeholder: String,
});
</script>
<template>
    <div>
        <label :for="id">{{label}}</label>
        <input :id="id" :placeholder="placeholder" class />
    </div>

</template>
<style scoped>

</style>
