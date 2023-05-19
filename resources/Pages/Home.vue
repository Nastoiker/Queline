<template>
    <div>
        Home
        {{user}}

    </div>
</template>


<style>

</style>
<script setup>
 import {storeToRefs} from "pinia";
 import {useUserStore} from "@/js/store/user";
 const userStore = useUserStore();
 const { user } = storeToRefs(userStore);
 userStore.fetchUser();
</script>
