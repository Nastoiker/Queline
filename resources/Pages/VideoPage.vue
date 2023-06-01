<template>
    <div v-if="currentVideo.path" class="w-full md:flex">
        <div class="mr-5 w-full">
            <video controls="controls" class=" w-full rounded-lg" :src="'/storage'+ currentVideo.path"></video>
            <div>
                <div>
                    <h1 class="text-2xl">{{ currentVideo.title }}</h1>
                    <span>{{ WordEnd(currentVideo.watches.length) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <div class="my-2 flex items-center space-x-5">
                        <div>

                        </div>
                        <img @click="router.push(`@${currentVideo.author.nickname}`)"
                             class="w-20 h-20 object-cover rounded-full"
                             :src="currentVideo.author.photo ? '/storage' + currentVideo.author.photo : defaultAvatar"
                             alt="">
                        <div>
                            <h1>
                                {{ currentVideo.author.nickname }}
                            </h1>
                        </div>
<!--                        <ButtonComponent @click="handleFollow(currentVideo.author.nickname)"  class="bg-green"> {{ userStore.checkIsFollow(currentVideo.author.nickname) ? 'Отписаться'  : 'Подписаться'}}</ButtonComponent>-->
                    </div>
                    <div
                        class="rounded-2xl h-fit p-2 space-x-3 flex bg-gray"
                    >
                        <Like
                            :count="currentVideo.grades.likes.length"
                            @like="handleLike"
                            :is-graded="isGraded(currentVideo.grades.likes)"
                        ></Like>
                        <div class="line-clamp-1"></div>
                        <Dislike
                            :count="currentVideo.grades.dislikes.length"
                            @dislike="handleDislike"
                            :is-graded="isGraded(currentVideo.grades.dislikes)"
                        ></Dislike>
                    </div>
                </div>

                <div class="ml-5 sm:ml-28 my-5 space-y-20">
                    <span class="block my-5">Дата создания: {{ DateNumber(new Date(currentVideo.created_at)) }}</span>
                    <p1>
                        Описание: {{currentVideo.description}}
                    </p1>
                </div>
            </div>
            <CommentsContainer @sendComment="handlePushComment">
                <Comment v-for="comment in currentVideo.comments" :user="comment"></Comment>
            </CommentsContainer>
        </div>
        <div  class="w-full sm:max-w-[300px]">
            <h1 class="text-xl">Другие видео</h1>
            <div class="mx-auto">

                <VideoContainer :show="true" :videos="video.filter(v=> (v.category.title === currentVideo.category.title && v.hash_id !==currentVideo.hash_id))" />
            </div>
        </div>

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
import router from "@/js/route";
import {useUserStore} from "@/js/store/user";
import VideoContainer from "@/components/Containers/VideoContainer.vue";


const videoStore =useVideoStore();
const route = useRoute()
const userStore = useUserStore();
const handleFollow = (nickname) => {
    userStore.followChannel(nickname);
}
const hash_id = route.params.hash_id;
videoStore.getVideo(hash_id);
const handleLike = () => {
    videoStore.setLike(hash_id)
}
const handleDislike = () => {
    videoStore.setDislike(hash_id)
}

const handlePushComment = (text) => {
    videoStore.pushComment(text, hash_id)
}

const isGraded = (data) => {
    return Boolean(data.find(item => item.nickname === localStorage.getItem('nickname')))
}
videoStore.getAllVideo();
const {currentVideo, video} = storeToRefs(videoStore);

const value = router.params;
</script>
