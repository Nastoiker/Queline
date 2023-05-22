<template>
    <router-link to="Home" name="Home"></router-link>
    <div>

    </div>
</template>
<script setup>

    import {useAdminstore} from "@/js/store/admin";

    const admin = useAdminstore();
</script>
