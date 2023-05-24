

<style>

</style>
<script setup>
 import {storeToRefs} from "pinia";
 import {useUserStore} from "@/js/store/user";
 import MainHome from "@/components/Main/MainHome.vue";
 import CategoryContainer from "@/components/Containers/CategoryContainer.vue";
 import {useAppStore} from "@/js/store/app";
 import {useVideoStore} from "@/js/store/video";

 // export default {
 //     components: {CategoryContainer}
 // }
 const userStore = useUserStore();
 const { user } = storeToRefs(userStore);
 userStore.fetchUser();
 const api = useVideoStore();
 const { categories } = storeToRefs(api);
 api.getCategories();
 console.log(categories);
</script>
<template>
    <div>
        <MainHome />
        <CategoryContainer :categories="categories" />
        Home
        {{user}}
    </div>
</template>
