<template>
    <div>
        <div>
            <img :src="userInfo.banner" alt="" />
            <div>
                <div>
                    <img :src="userInfo.photo" alt="">
                    <div>
                        <h2>{{userInfo.nickname}}}</h2>
                    </div>
                </div>
                <button></button>
            </div>
        </div>
    </div>
</template>

<script setup>
    import {useUserStore} from "../js/store/user";

    const userStore = useUserStore();
    const userInfo = userStore.fetchUser();
</script>
