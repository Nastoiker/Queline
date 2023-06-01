<template>
    <form @submit.prevent="createVideo">

        <div class="sm:flex justify-around w-full ">
            <div>

                <div v-if=" video  && video.length>0">
                    <button type="button" @click="removeVideo()"
                            class="rounded-full hover:bg-white hover:bg-opacity-25 p-2 focus:outline-none text-white transition duration-200">
                        <svg class="ml-auto" width="23" height="23" viewBox="0 0 23 23" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <rect width="28.9691" height="3.10383" rx="1.55192"
                                  transform="matrix(0.707129 0.707085 -0.707129 0.707085 2.51465 0.321777)"
                                  fill="#D9D9D9"/>
                            <rect width="28.9691" height="3.10383" rx="1.55192"
                                  transform="matrix(0.707129 -0.707085 0.707129 0.707085 0 20.4838)" fill="#D9D9D9"/>
                        </svg>
                    </button>
                    <video class="max-w-[600px] mb-20 max-h-[400px] h-auto" controls="controls" :src="video"
                           alt="fileName">
                    </video>
                </div>
                <div v-if=" preview && preview.length>0">
                    <button type="button" @click="removeImg"
                            class="rounded-full hover:bg-white hover:bg-opacity-25 p-2 focus:outline-none text-white transition duration-200">
                        <svg class="ml-auto" width="23" height="23" viewBox="0 0 23 23" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <rect width="28.9691" height="3.10383" rx="1.55192"
                                  transform="matrix(0.707129 0.707085 -0.707129 0.707085 2.51465 0.321777)"
                                  fill="#D9D9D9"/>
                            <rect width="28.9691" height="3.10383" rx="1.55192"
                                  transform="matrix(0.707129 -0.707085 0.707129 0.707085 0 20.4838)" fill="#D9D9D9"/>
                        </svg>
                    </button>
                    <img class="mb-28 max-w-[700px]" :src="preview" alt="fileName" style="max-height: 256px">
                </div>
                <InputFile v-if="!video" class="mb-32" @file-updated="videoHandle" label="Видео"/>
                <InputFile v-if="!preview" accept="video/*" class="mb-32" @file-updated="previewImg" label="Превью"/>
            </div>
            <div>
                <BaseInput label="" v-model="Title" placeholder="Название видео"/>
                <BaseInput label="" v-model="Description" placeholder="Описание"/>
                <Select :options="categories"
                        :default="'Категория'"
                        class="select my-5"
                        @input="setCategoryId"/>


            </div>
        </div>
        <ButtonComponent class="my-10">Создать видео</ButtonComponent>
        <Notify :show="showNotify">Видео загружено</Notify>
        <div class="my-48">
            {{ userStore.errorCreate }}
        </div>


    </form>
</template>


<script setup>
import Notify from '@/components/notify/Notify.vue'
import {useUserStore} from "@/js/store/user";
import BaseInput from "@/components/Input/BaseInput.vue";
import {ref} from "vue";
import Select from '@/components/Select/Select.vue'
import ButtonComponent from "@/components/Button/ButtonComponent.vue";
import InputFile from "@/components/InputFile/InputFile.vue";
import {useVideoStore} from "@/js/store/video";
import {storeToRefs} from "pinia";

const videoFile = ref({});
const video = ref();
const Title = ref("");
const Description = ref("");
const preview = ref();
const previewFile = ref({});
const categoryId = ref("");

const showNotify = ref(false);

const userStore = useUserStore();
const api = useVideoStore();
const removeVideo = () => {
    video.value = null;
    videoFile.value = null;
}
const removeImg = () => {
    preview.value = null;
    previewFile.value = null;
}

const setCategoryId = (id) => {
    categoryId.value = id;
}
const {categories} = storeToRefs(api);
api.getCategories();

function previewImg(file) {
    // previewFile.value = file.target.files;
    preview.value = file.previewBase64;
    previewFile.value = file;
    console.log(1);
}

function videoHandle(file) {
    // videoFile.value = file.target.files;
    videoFile.value = file;
    video.value = file.previewBase64;
}

const createVideo = () => {
    console.log({
        preview: previewFile.value,
        video: videoFile.value,
        description: Description.value,
        title: Title.value,
        tags: JSON.stringify([]),
        category_id: categoryId.value,
    });
    userStore.createVideo({
        preview: previewFile.value,
        video: videoFile.value,
        description: Description.value,
        title: Title.value,
        tags: JSON.stringify([]),
        category_id: categoryId.value,
    }).then(
        () => showNotify.value = true
    );

}
</script>
