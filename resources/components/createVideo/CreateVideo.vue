<template>
    <form @submit.prevent="createVideo">

        <div class="sm:flex justify-around w-full ">
            <div>
                <img class="mb-28" v-if="preview.length>0"  :src="preview" alt="fileName" style="max-height: 256px">
                <video controls="controls" v-if="video" :src="video" alt="fileName" style="max-height: 256px" >
                </video>
                <BaseInput label="Видео" @change="videoHandle" type="file"/>-->
                        <BaseInput label="Превью" @change="previewImg" type="file"/>
                <InputFile  class="mb-32" @file-updated="videoHandle" label="Видео"/>
                <InputFile accept="video/*" class="mb-32" @file-updated="previewImg" label="Превью"/>
                <Select  :options="categories"
                         :default="'Категория'"
                         class="select my-48 z-20"
                         @input="setCategoryId"/>
            </div>
            <div>

                <BaseInput label="Описание" v-model="Description"/>
                <BaseInput label="Название" v-model="Title"/>
                <ButtonComponent >Создать видео</ButtonComponent>

            </div>
        </div>
        <div class="my-48">
            {{userStore.error}}
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
