<template>
    <div >
        <transition
            name="popup"
            mode="in-out"
            enter-from-class="popup-enter-from"
            leave-to-class="popup-leave-to"
            enter-to-class="popup-enter-to"
            leave-from-class="popup-leave-from"
        >
            <div v-if="show" class="popup p-20 rounded-md  fixed w-[300px] h-[250px] bg-gray z-30" :key="123">
                <div class="w-full text-center ">
                    <slot></slot>
                </div>
                <div
                    class="w-full bg-green rounded-full text-center my-5 cursor-pointer"
                    @click="show = false"
                >Закрыть</div>
            </div>
        </transition>
    </div>
</template>

<script setup>
import { defineComponent, ref } from 'vue';

// export default defineComponent({
//     name: 'Popup',
// });
const props = defineProps({
    show: {
        type: Boolean,
        default: false
    }
});
const name = defineComponent({
    name: 'Popup'
})
</script>

<style scoped>
.popup {
    left: calc(50% - 150px);
    top: calc(50% - 125px);
}

.popup-enter-from, .popup-leave-to {
    transform: translateY(-50px);
    opacity: 0;
}

.popup-enter-active {
    transition: all 0.3s;
}

.popup-leave-active {
    transition: all 0.3s;
}

.popup-enter-to, .popup-leave-from {
    transform: translateY(0px);
    opacity: 1;
}
:slotted(*) {
    text-align: center;
    font-size: 24px;
    width: auto;
}
</style>
