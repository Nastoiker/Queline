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
                <BaseTextarea  label="" v-model="Description" placeholder="Описание"/>
                <TagField @updateTags="updateTags" />
                <Select :options="categories"
                        :default="'Категория'"
                        class="select my-5"
                        @input="setCategoryId"/>


            </div>
        </div>
        <div v-if="loading" class=" sm:ml-40 flex items-center text-4xl">Видео загружается <svg
            class="animate-spin  mx-3 h-16 w-16 text-white"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
        >
            <circle
                class="opacity-25"
                cx="12"
                cy="12"
                r="10"
                stroke="currentColor"
                stroke-width="4"
            ></circle>
            <path
                class="opacity-75"
                fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
            ></path>
        </svg> </div>
        <button :disabled="loading" class="sm:ml-40  my-10 bg-green px-5 py-2 rounded-full">Создать видео</button>
        <Notify :show="showNotify">Видео загружено</Notify>
        <Notify :show="error">Ошибка! не все данные заполнены</Notify>
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
import BaseTextarea from "@/components/Textarea/BaseTextarea.vue";
import TagField from "@/components/createVideo/TagField.vue";

const videoFile = ref({});
const video = ref();
const Title = ref("");
const Description = ref("");
const preview = ref();
const previewFile = ref({});
const categoryId = ref("");
const tagsVideo = ref([]);

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
const loading = ref(false);
const error = ref(false);
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

function updateTags(tags) {
    tagsVideo.value = tags
}

const createVideo = () => {
    console.log({
        preview: previewFile.value,
        video: videoFile.value,
        description: Description.value,
        title: Title.value,
        tags: [...tagsVideo.value],
        category_id: categoryId.value,
    });
    loading.value= true;
    error.value = false;
    if( !previewFile.value ||  !videoFile.value  || !Title.value || typeof categoryId.value !== "number") { error.value = true; loading.value = false; return;};
    userStore.createVideo({
        preview: previewFile.value,
        video: videoFile.value,
        description: Description.value,
        title: Title.value,
        tags: JSON.stringify(tagsVideo.value),
        category_id: categoryId.value,
    }).then(
        () => {  videoFile.value=null; categoryId.value=null; previewFile.value=null;Description.value=null ; Title.value=null; tagsVideo.value=null ;showNotify.value = true;  loading.value= false; }
    );

}
</script>
<style scoped>
button:disabled {
    @apply bg-gray;
}
</style>
