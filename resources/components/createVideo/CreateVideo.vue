<template>
    <form @submit="createVideo">

        <div class="sm:flex justify-around w-full ">
            <div>
                <img class="mb-28" v-if="preview.length>0"  :src="preview" alt="fileName" style="max-height: 256px">
                <video controls="controls" v-if="videoFile" :src="videoFile" alt="fileName" style="max-height: 256px" >
                </video>
                <InputFile  class="mb-32" @file-updated="videoHandle($event)" label="Видео"/>
                <InputFile class="mb-32" @file-updated="previewImg($event)" label="Превью"/>
                <Select  :options="['go', 'python', 'rust', 'javascript']"
                         :default="'go'"
                         class="select my-48 z-20"
                         @input="console.log($event)"/>
            </div>
            <div>
                <BaseInput label="Описание" v-model="Description"/>
                <BaseInput label="Название" v-model="Title"/>
                <ButtonComponent >Создать видео</ButtonComponent>

            </div>
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
 const videoFile = ref();
 const Title = ref("");
 const Description = ref("");
const preview = ref({})
 const userStore = useUserStore();
 function previewImg($event) {
     // preview.value = event.target.files[0];
     preview.value =  $event.previewBase64;
     console.log(1);
 }
 function videoHandle($event) {
     // videoFile.value = event.target.files[0];

     videoFile.value = $event.previewBase64;
 }
 const createVideo = (e) => {
     e.preventDefault();
     console.log({
         preview: preview.value,
         video: videoFile.value,
         description: Description.value,
         title: Title.value,
         tags: [],
         category_id: 1,
     });
     userStore.createVideo({
            preview: preview.value,
         video: videoFile.value,
         description: Description.value,
         title: Title.value,
         tags: [],
         category_id: 1,
     });

 }
</script>
