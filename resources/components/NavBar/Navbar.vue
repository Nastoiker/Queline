<template>
    <div class="top-10">
        <div class="flex  items-center space-x-10">
            <button id="menuButton" class="h-10 w-10 "  @click="isOpen=!isOpen">
                <svg width="62" height="17" viewBox="0 0 62 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="62" height="4" rx="2" :fill="isDark ? '#D9D9D9' : '#303236'"/>
                <rect y="13" width="62" height="4" rx="2" :fill="isDark ? '#D9D9D9' :  '#303236'"/>
            </svg>
            </button>
            <img @click="route.push('/')" :src="logo" class="hidden sm:block w-full h-8" alt="">

        </div>

        <Transition name="slide-fade">
            <div id="menu" class="p-2 text-white text-md sm:text-2xl space-y-5 sm:p-10 bg-gray h-full top-0 fixed left-0 z-50 block w-[40vw] min-w-[200px] max-w-[500px]" @clickout="isOpen = !isOpen" v-if="isOpen">
               <div class="ml-auto flex items-center">
                   <img @click="route.push('/')" :src="logo" class=" w-full h-8" alt="">
                   <button  class=" w-full" @click="isOpen = !isOpen"><svg class="ml-auto" width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                       <rect width="28.9691" height="3.10383" rx="1.55192" transform="matrix(0.707129 0.707085 -0.707129 0.707085 2.51465 0.321777)" fill="#D9D9D9"/>
                       <rect width="28.9691" height="3.10383" rx="1.55192" transform="matrix(0.707129 -0.707085 0.707129 0.707085 0 20.4838)" fill="#D9D9D9"/>
                   </svg>
                   </button>
               </div>


                <ul class="space-y-5">
                    <li>
                        <router-link :to="{ path: '/home' }" name="home">Главная</router-link>
                    </li>
                    <li>
                        <router-link :to="{ path: '/createVideo' }" name="create_video">Создать видео</router-link>
                    </li>
                    <li>
                        <router-link v-if="!user.nickname" :to="{ path: '/register' }" name="register">Регистрация</router-link>
                    </li>
                    <li>
                        <router-link  v-if="!user.nickname" :to="{ path: '/login' }" name="login">Авторизация</router-link>
                    </li>
                    <li>
                        <router-link :to="{ path: '/profile' }" name="profile">Профиль</router-link>
                    </li>
                    <li>
                        <router-link :to="{ path: '/profile/createVideo' }" name="create_video">Создать видео</router-link>
                    </li>
                </ul>
                <button v-if="user.role_id===1" class="block">
                    <router-link to="/admin" name="admin">Войти в админку</router-link>
                </button>
                <button class="bottom-20" @click="auth.logout()">
                    выйти
                </button>
            </div>
        </Transition>
    </div>

</template>
<script setup>
import {ref} from "vue";
import {useUserStore} from "@/js/store/user";
import {useAuthStore} from "@/js/store/auth";
import {storeToRefs} from "pinia";
import logo from '@/assets/logo.svg';
import route from "@/js/route/index.js";
import {useDark} from "@vueuse/core";
const userStore = useUserStore();
const auth = useAuthStore();
const { user } = storeToRefs(userStore);
const isDark = useDark();

userStore.fetchUser();
</script>

<style scope>
.slide-fade {
    position: fixed;
    z-index: 999999;
}

.slide-fade-enter-active {
    transition: all 0.3s ease-out;

}

.slide-fade-leave-active {
    transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);

}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(-500px);
    opacity: 0;
}
</style>
<script>
import {ref} from "vue";
import  router from '@/js/route/index';
import { onMounted, reactive, watch } from 'vue'
export default  {
    data () {
        return {
            isOpen: false,
            currentUrl: router.currentRoute,
        }
    },
    watch: {
        currentUrl(newUrl, oldUrl) {
            if( newUrl !==oldUrl) {
                this.isOpen = false;
            }
        }
    },
    methods: {
        toggle() {
            this.isOpen = false;
        },
        outElement(e) {


                if (!document.getElementById('menu')?.contains(e.target) && !document.getElementById('menuButton')?.contains(e.target)) {
                    // Ниже код, который нужно выполнить при срабатывании события.

                    if(this.isOpen) { this.isOpen = false}
                }
        }
    },
    created: function() {
        window.addEventListener('click', this.outElement);
    },


}

</script>

<!--<script setup>-->
<!--    import {reactive} from "vue";-->

<!--    const isOpen = reactive({-->
<!--        isOpen-->
<!--    });-->
<!--</script>-->
