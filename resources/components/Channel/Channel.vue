<template>
    <div class="flex-col">
        <img src="" class="rounded-full w-28 h-28" alt="">
        <div>
            <h1>
                {{name}}
            </h1>
            <p>{{countSubs}} Подписчиков</p>
            <ButtonComponent>{{ isFollow ? 'Отписаться' : 'Подписаться'}}</ButtonComponent>
        </div>
    </div>
</template>
<script setup>
const props = defineProps({
    isFollow: Boolean,
    channel: Object,
})
</script>
<script>
import ButtonComponent from "../Button/ButtonComponent";
export default {
    components: {ButtonComponent}
}
</script>
