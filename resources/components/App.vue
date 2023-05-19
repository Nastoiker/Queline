<template>

<div class="max-w-screen-2xl mx-auto">
    <Header />
    <NavBar></NavBar>
    <div class="max-w-screen-sm mx-auto">
        <router-view />

    </div>
</div>

</template>
<script setup>
import '../css/app.css'
import ButtonComponent from "./Button/ButtonComponent.vue";
import Header from '@/components/Header/Header.vue';
</script>

<style scoped>

</style>
