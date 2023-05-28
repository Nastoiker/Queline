<template>
    <div class="top-10">
        <div class="flex  items-center space-x-10">
            <button id="menuButton" class="h-10 w-10 "  @click="isOpen  = !isOpen"><svg width="62" height="17" viewBox="0 0 62 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="62" height="4" rx="2" fill="#D9D9D9"/>
                <rect y="13" width="62" height="4" rx="2" fill="#D9D9D9"/>
            </svg>
            </button>
            <img @click="scrollToTop" :src="logo" class="w-full h-8" alt="">

        </div>

        <Transition name="slide-fade">
            <div id="menu" class="p-2  text-md sm:text-2xl space-y-5 sm:p-10 bg-gray h-full top-0 fixed left-0 z-50 block w-[40vw] min-w-[200px] max-w-[500px]" @clickout="isOpen = !isOpen" v-if="isOpen">
                <button  class=" w-full" @click="isOpen = !isOpen"><svg class="ml-auto" width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="28.9691" height="3.10383" rx="1.55192" transform="matrix(0.707129 0.707085 -0.707129 0.707085 2.51465 0.321777)" fill="#D9D9D9"/>
                    <rect width="28.9691" height="3.10383" rx="1.55192" transform="matrix(0.707129 -0.707085 0.707129 0.707085 0 20.4838)" fill="#D9D9D9"/>
                </svg>
                </button>
                <div v-if="!user.nickname">
                    <router-link class="block" to="/register">Зарегестрироваться </router-link>
                    <router-link to="/login">Войти </router-link>
                </div>
                <ul>
                    <li v-for="(link, index) in links" :key="index">
                        <router-link :to="{ path: link.path }">{{ link.name }}</router-link>
                    </li>
                </ul>
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

const userStore = useUserStore();
const auth = useAuthStore();
const { user } = storeToRefs(userStore);
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

export default  {
    data () {
        return {
            isOpen: false,
            links: [],
        }
    },
    methods: {
            scrollToTop() {
                document.getElementById('app').scrollIntoView({ behavior: 'smooth' });
            },
        toggle() {
            this.isOpen = false;
        },
        outElement(e) {

                if (!document.getElementById('menu')?.contains(e.target) && !document.getElementById('menuButton')?.contains(e.target)) {
                    // Ниже код, который нужно выполнить при срабатывании события.
                    console.log(1);
                    if(this.isOpen) { this.isOpen = false}
                }
        }
    },
    created: function() {
        window.addEventListener('click', this.outElement);

        const routes = router.getRoutes()

        this.links = routes.map(route => {
            return {
                path: route.path,
                name: route.name ? route.name : route.path.substring(1),
            }
        })
    },


}

</script>

<!--<script setup>-->
<!--    import {reactive} from "vue";-->

<!--    const isOpen = reactive({-->
<!--        isOpen-->
<!--    });-->
<!--</script>-->
