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
        <input  class="search__icon__input" :id="id" :placeholder="placeholder" class />
    </div>

</template>
<style scoped>
input .search__icon__input {
        background: url("../../assets/Search.svg");
    }
</style>
