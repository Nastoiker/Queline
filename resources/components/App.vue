<template>

<div class="bg-gray-200">
    <ButtonComponent :error="sasds">sadsad</ButtonComponent>
    <router-view />

</div>

</template>
<script>
import '../css/app.css'
import ButtonComponent from "./Button/ButtonComponent.vue";
export default {
    name: "App",
    components: {ButtonComponent}
}
</script>

<style scoped>

</style>
