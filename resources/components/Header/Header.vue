<template>
    <div class="max-w-[1500px] w-full fixed top-0 z-50">
        <div class="flex justify-between items-center">
            <Navbar />
            <Search label="поиск" />
            <div>
                <router-link to="/register">Войти </router-link>
                <router-link to="/login">Зарегестрироваться </router-link>
            </div>
        </div>


    </div>

</template>
<script setup>
import Search from '@/components/Search/Seach.vue'
import Navbar from '@/components/NavBar/Navbar.vue'
</script>
