<template>
    <div>
        <img :src="category.photo" alt="">
        <h1>{{category.name}}</h1>
    </div>
</template>
<script setup>
const props = defineProps({
    category: Object,
});
</script>
