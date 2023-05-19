<template>
    <div>
        <div>
            <img :src="user.banner" alt="" />
            <div>
                <div>
                    <img :src="user.photo" alt="">
                    <div>
                        <h2>{{user.nickname}}</h2>
                    </div>
                </div>
                <button></button>
                <router-link to="/profile/createVideo" name="create_video" >Создать видео</router-link>
            </div>
        </div>
    </div>
</template>

<script setup>
    import {useUserStore} from "../js/store/user";
    import {storeToRefs} from "pinia";

    const userStore = useUserStore();
    const userInfo = userStore.fetchUser();
    const { user } = storeToRefs(userStore);
    userStore.fetchUser();
</script>
