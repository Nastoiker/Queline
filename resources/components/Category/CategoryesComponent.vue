<template>
    <div v-bind="$attrs" >
<!--        <img :src="category.photo" alt="">-->
        <div class="w-10 h-10 bg-white">
        </div>
        <h1>{{category.title}}</h1>
    </div>
</template>
<script setup>
const props = defineProps({
    category: Object,
});
</script>
