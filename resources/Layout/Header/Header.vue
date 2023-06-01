<template>
    <div>

    </div>
</template>
<script setup>
    import {useUserStore} from "@/js/store/user";

    const user = useUserStore().fetchUser();
</script>
