

<style>

</style>
<script setup>
 import {storeToRefs} from "pinia";
 import {useUserStore} from "@/js/store/user";
 import MainHome from "@/components/Main/MainHome.vue";

 // export default {
 //     components: {CategoryContainer}
 // }
 const userStore = useUserStore();
 const { user } = storeToRefs(userStore);
 userStore.fetchUser();
</script>
<template>
    <div>
        <MainHome />

        Home
        {{user}}
        <!--        <CategoryContainer :categories="[{name:'lol', photo:""}]" />-->
    </div>
</template>
