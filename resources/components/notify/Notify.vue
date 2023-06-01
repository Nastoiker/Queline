<template>

</template>

<script>
import { defineComponent, ref } from 'vue';

export default defineComponent({
    name: 'Popup',
    setup() {
        const show = ref(false);

        function hide() {
            show.value = false;
        }

        return { show, hide };
    }
});
</script>

<style>
.popup-enter-active,
.popup-leave-active {
    transition: transform 0.3s cubic-bezier(0, 0.3, 0.3, 1);
}

.popup-enter {
    transform: translateY(100%);
}

.popup-enter-to {
    transform: translateY(0);
}

.popup-leave {
    transform: translateY(0);
}

.popup-leave-to {
    transform: translateY(100%);
}
</style>
