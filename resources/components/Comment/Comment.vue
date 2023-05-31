<template>
    <div class="w-full flex my-6">
        <div class="w-[62px] h-[62px] rounded-full bg-gray mr-6">
            <img :src="user.photo" alt="">
        </div>
        <div class="text-start">
            <h4>{{ user.nickname }} &middot; <span>{{ formatDate(user.created_at) }}</span></h4>
            <div>{{ user.text }}</div>
            <div class="flex justify-between w-[90px] my-2">
                <CommentLike
                    :count="user.grades.likes.length"
                    @commentLike="setLike"
                ></CommentLike>
                <div class="line-clamp-1 w-0.5 bg-white shrink-0"></div>
                <CommentDislike
                    :count="user.grades.dislikes.length"
                    @commentDislike="setDislike"
                ></CommentDislike>
            </div>
        </div>
    </div>
</template>
<script setup>
import {useVideoStore} from "@/js/store/video";
import formatDate from "@/js/helpler/date";
import CommentLike from "@/components/Comment/CommentLike.vue";
import CommentDislike from "@/components/Comment/CommentDislike.vue";
import {useRoute} from "vue-router";

const props = defineProps({
    user: Object,
});
const route = useRoute();
const hash_id = route.params.hash_id;

const video = useVideoStore();

const setLike = () => {
    video.setCommentGrade(props.user.id, 1, hash_id);
}

const setDislike = () => {
    video.setCommentGrade(props.user.id, 2, hash_id);
}


</script>
