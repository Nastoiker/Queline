<script setup>
import '../css/app.css'
import ButtonComponent from "./Button/ButtonComponent.vue";
import Header from '@/components/Header/Header.vue';
import Navbar from '@/components/NavBar/Navbar.vue'

</script>

<template>
<div class=" overflow-hidden">
    <div class="max-w-[1720px] mx-auto ">
        <Header  />
        <div class="my-20">
            <router-view />

        </div>

    </div>
</div>

</template>


<style scoped>

</style>
