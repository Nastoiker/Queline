<template>
    <form  @submit.prevent="EditProfile">
        <div class="flex justify-between">
            <Avatar  :defaultSrc="img"  @input="uploadImage" class="rounded-full w-40 h-40"/>
            <div>
                <Bunner :defaultSrc="bunnerImg" @text-updated="HandleError" @file-updated="uploadBunner"  class=" w-fit h-40" />
                <h1>{{errorBunner }}asdasdasds</h1>
            </div>
        </div>

        <button type="submit">Создать</button>
    </form>

</template>
<script setup>
import img from '@/assets/user.jpg'
import Avatar from "@/components/AvatarComponent/Avatar.vue";
import bunnerImg from '@/assets/banner.jpg';
import Bunner from '@/components/Bunner/Bunner.vue'
import {useUserStore} from "@/js/store/user";
import {ref} from "vue";
const AvatarFile = ref({});
const BunnerFile = ref({});
const errorBunner = ref('');
const user = useUserStore();

function HandleError(error){
    errorBunner.value = error;
}
const uploadImage = (e) => {
    AvatarFile.value = e;
}
const EditProfile = () => {
    console.log({
        photo: AvatarFile.value,
        banner: BunnerFile.value,
        nickname: 'Dami',
    });
     user.editProfile({
        photo: AvatarFile.value,
        banner: BunnerFile.value,
        nickname: 'Dami',
    });
}
const uploadBunner = (e) => {
    BunnerFile.value = e;
}
</script>
