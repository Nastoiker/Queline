<template>
    <div v-if="currentVideo.path" class="w-11/12">
        <div class="w-fit">
            <video controls="controls" class="rounded-lg" :src="'/storage'+ currentVideo.path"></video>
            <div>
                <div>
                    <h1 class="text-2xl">{{ currentVideo.title }}</h1>
                    <span>{{ WordEnd(currentVideo.watches.length) }}</span>
                </div>
                <div class="my-2 flex space-x-5">
                    <img class="w-20 h-20 object-cover rounded-full"
                         :src="currentVideo.author.photo ? '/storage' + currentVideo.author.photo : defaultAvatar"
                         alt="">
                    <div>
                        <h1>
                            {{ currentVideo.author.nickname }}
                        </h1>
                    </div>
                    <ButtonComponent class="bg-green">Подписаться</ButtonComponent>
                    <div
                        class="rounded-2xl h-fit p-2 space-x-3 flex bg-gray"
                    >
                        <Like
                            :count="currentVideo.grades.likes.length"
                            @like="handleLike"
                        ></Like>
                        <div class="line-clamp-1"></div>
                        <Dislike
                            :count="currentVideo.grades.dislikes.length"
                            @dislike="handleDislike"
                        ></Dislike>
                    </div>
                </div>
                {{ DateNumber(new Date(currentVideo.created_at)) }}
            </div>
            <CommentsContainer @sendComment="handlePushComment">
                <Comment v-for="comment in currentVideo.comments" :user="comment"></Comment>
            </CommentsContainer>
        </div>

        <!--        <form @submit.prevent="">-->
        <!--            <label class="block">Оставьте свой комментарий</label>-->
        <!--            <textarea cols="40" rows="5" />-->
        <!--        </form>-->
    </div>
</template>
<script setup>
import {useRoute} from "vue-router";
import defaultAvatar from "@/assets/user.jpg";
import {useVideoStore} from "@/js/store/video";
import {storeToRefs} from "pinia";
import WordEnd from "../js/helpler/word";
import ButtonComponent from "@/components/Button/ButtonComponent.vue"
import {DateNumber} from "@/js/helpler/date";
import Like from "@/components/Video/Like.vue";
import Dislike from "@/components/Video/Dislike.vue";
import CommentsContainer from "@/components/Containers/CommentsContainer.vue";
import Comment from "@/components/Comment/Comment.vue";

const video = useVideoStore();
const route = useRoute()

const hash_id = route.params.hash_id;
video.getVideo(hash_id);
const handleLike = () => {
    video.setLike(hash_id)
}
const handleDislike = () => {
    video.setDislike(hash_id)
}

const handlePushComment = (text) => {
    video.pushComment(text, hash_id)
}

const {currentVideo} = storeToRefs(video);

const value = route.params;
</script>
