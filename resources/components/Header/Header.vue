<template>
    <div class="max-w-[1500px] w-full fixed top-0 z-50">
        <div class="flex justify-between items-center">
            <Navbar />
            <Search label="поиск" />
            <div v-if="user" class="flex items-center">
                <router-link to="/profile">
                    <img
                        class="w-12 h-12 object-cover rounded-full"
                        :src="user.photo ? user.photo : defaultAvatar"
                        alt=""
                    />
                </router-link>
                <router-link to="/profile">
                    <img
                        class="w-12 h-12 object-cover rounded-full"
                        :src="user.photo ? user.photo : defaultAvatar"
                        alt=""
                    />
                </router-link>
            </div>
            <div v-else>
                <router-link to="/register">Войти </router-link>
                <router-link to="/login">Зарегестрироваться </router-link>
            </div>
        </div>
    </div>
</template>
<script setup>
import Search from "@/components/Search/Seach.vue";
import Navbar from "@/components/NavBar/Navbar.vue";
import { storeToRefs } from "pinia";
import defaultAvatar from "@/assets/user.jpg";
import { useUserStore } from "../../js/store/user";
const userStore = useUserStore();
const { user } = storeToRefs(userStore);
userStore.fetchUser();
</script>
