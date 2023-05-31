<template>
    <div class="mx-auto w-full">
        <h3 class="text-[24px] mb-6">Комментарии</h3>
        <div class="flex justify-between items-center">
            <div class="rounded-full w-[62px] h-[62px] bg-gray"></div>
            <CommentForm @sendComment="(text) => $emit('sendComment', text)"></CommentForm>
        </div>

        <div class="mx-auto sm:mx-0">
           <slot></slot>
        </div>
    </div>
</template>
<script setup>
import CommentForm from '@/components/Comment/CommentForm.vue';
</script>
