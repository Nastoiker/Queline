<template>
    <header v-bind:class="{ scrolled: isScrolled }" class="max-w-[1500px] w-full fixed top-0 z-50">
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
                <router-link to="/">
                   выйти
                </router-link>
            </div>
            <div v-else>
                <router-link to="/register">Войти </router-link>
                <router-link to="/login">Зарегестрироваться </router-link>
            </div>
        </div>
    </header>
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
<script>
export default {
    data() {
        return {
            isScrolled: false,
        }
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll)
    },
    updated() {
        window.addEventListener('scroll', this.handleScroll)
    },
    beforeDestroy() {
        window.removeEventListener('scroll', this.handleScroll)
    },
    methods: {
        handleScroll() {
            this.isScrolled = window.pageYOffset > 20
        }
    },
}
</script>
<style scoped>
header.scrolled {
    background-color: #796d6d;
}
</style>
