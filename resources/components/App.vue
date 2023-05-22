<script setup>
import '../css/app.css'
import ButtonComponent from "./Button/ButtonComponent.vue";
import Header from '@/components/Header/Header.vue';
import Navbar from '@/components/NavBar/Navbar.vue'

</script>

<template>
<div>
    <div class="max-w-screen-2xl mx-auto">
        <Header  />
        <div class="my-20">
            <router-view />

        </div>

    </div>
</div>

</template>


<style scoped>

</style>
