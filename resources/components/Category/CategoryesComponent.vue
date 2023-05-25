<template>
    <div class="text-center mx-5 min-w-20" v-bind="$attrs">
        <!--        <img :src="category.photo" class="rounded-md" alt="">-->
        <div class="w-full min-w-10 h-48 rounded-md bg-white"></div>
        <h1>{{ category.title }}</h1>
    </div>
</template>
<script setup>
const props = defineProps({
    category: Object,
});
</script>
