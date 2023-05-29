<template>
    <div class="flex mx-auto  flex-wrap sm:gap-[30px]">
        <div class="mx-auto sm:mx-0"  v-for="v of comments" :key="v.hash_id">
           <Comment />
        </div>
    </div>

</template>
<script setup>
import VideoData from "@/components/Video/VideoData.vue";
import Comment from "@/components/Comment/Comment.vue";
const props = defineProps({
    comments: Array,
})
</script>
