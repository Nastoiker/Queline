

<style>

</style>
<script setup>
 import {storeToRefs} from "pinia";
 import {useUserStore} from "@/js/store/user";
 import MainHome from "@/components/Main/MainHome.vue";
 import CategoryContainer from "@/components/Containers/CategoryContainer.vue";
 import {useAppStore} from "@/js/store/app";
 import {useVideoStore} from "@/js/store/video";
 import {useDark, useToggle} from "@vueuse/core";

 // export default {
 //     components: {CategoryContainer}
 // }
 const api = useVideoStore();
 const { categories } = storeToRefs(api);
 api.getCategories();
 const userStore = useUserStore();
 const { user } = storeToRefs(userStore);
 userStore.fetchUser();
const isDark = useDark();
const toggleDark = useToggle(isDark);
 console.log(categories);
</script>
<template v-if="categories.length>0">
    <div>
        <button @click="toggleDark()">changeColor</button>
        <MainHome />
        <div v-if="categories.length>5" class="dark:bg-white">
            <CategoryContainer :categories="categories" />

        </div>
        Home
        {{user}}
    </div>
</template>
