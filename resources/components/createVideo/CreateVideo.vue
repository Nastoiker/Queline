<template>
    <form @submit.prevent="createVideo">

        <div class="sm:flex justify-around w-full ">
            <div>
                <div  v-if="preview.length>0">
                    <button type="button" @click="remove" class="rounded-full hover:bg-white hover:bg-opacity-25 p-2 focus:outline-none text-white transition duration-200">
                        <svg  height="30" width="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M2.9918 21C2.44405 21 2 20.5551 2 20.0066V3.9934C2 3.44476 2.45531 3 2.9918 3H21.0082C21.556 3 22 3.44495 22 3.9934V20.0066C22 20.5552 21.5447 21 21.0082 21H2.9918ZM20 15V5H4V19L14 9L20 15ZM20 17.8284L14 11.8284L6.82843 19H20V17.8284ZM8 11C6.89543 11 6 10.1046 6 9C6 7.89543 6.89543 7 8 7C9.10457 7 10 7.89543 10 9C10 10.1046 9.10457 11 8 11Z"></path></svg>
                    </button>
                    <img class="mb-28"  :src="preview" alt="fileName" style="max-height: 256px">
                </div>
                <div v-if="video">
                    <button>x</button>
                    <video controls="controls"  :src="video" alt="fileName" style="max-height: 256px" >
                    </video>
                </div>
                <InputFile v-if="!preview.length>0" class="mb-32" @file-updated="videoHandle" label="Видео"/>
                <InputFile v-if="!video.length>0" accept="video/*" class="mb-32" @file-updated="previewImg" label="Превью"/>
                <ButtonComponent class="my-10">Создать видео</ButtonComponent>
            </div>
            <div>

                <BaseInput label="Описание" v-model="Description"/>
                <BaseInput label="Название" v-model="Title"/>
                <Select  :options="categories"
                         :default="'Категория'"
                         class="select h-full my-5 z-20"
                         @input="setCategoryId"/>


            </div>
        </div>
        <div class="my-48">
            {{userStore.errorCreate}}
        </div>


    </form>
</template>


<script setup>

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
const preview = ref({});
const previewFile = ref({});
 const categoryId = ref("");
 const userStore = useUserStore();
const api = useVideoStore();
const removeVideo = () => {
    video.value = null;
}
 const removeImg = () => {
     preview.value = null;
 }

const setCategoryId = (id) => {
    categoryId.value = id;
}
 const { categories } = storeToRefs(api);
 api.getCategories();
 function previewImg(file) {
     // previewFile.value = file.target.files;
     preview.value =  file.previewBase64;
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
         tags: [],
         category_id: categoryId.value,
     });
     userStore.createVideo({
            preview: previewFile.value,
         video: videoFile.value,
         description: Description.value,
         title: Title.value,
         tags: [],
         category_id: categoryId.value,
     });

 }
</script>
