<template>
    <div class="flex items-center ml-2">
        <div
            class="main-comment-dislike w-[16px] h-[16px] mr-3 cursor-pointer"
            @click="$emit('commentDislike')"
        ></div>

        <div>{{count}}</div>
    </div>
</template>

<script setup>
const props = defineProps({
   count: {
       type: Number,
       default: 0
   }
});
</script>

<style scoped>
.main-comment-dislike {
    background-image: url("/resources/assets/Vector_dislike.svg");
    background-size: contain;
    background-repeat: no-repeat;
}
</style>
