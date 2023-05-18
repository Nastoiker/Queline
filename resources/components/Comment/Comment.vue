<template>
    <div>
        <img :src="user.photo" alt="">
        <div class="text-start">
            <h4>{{user.nickname}}</h4>
            <p>{{comment}}}</p>
        </div>
    </div>
</template>
<script setup>
    const props = defineProps({
        user: Object,
        comment: String,
    });
</script>
