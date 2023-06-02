<template>
    <div class="flex mx-auto  flex-wrap sm:gap-[30px]">
        <div class="mx-auto sm:mx-0"  v-for="v in videos">
            <VideoAdminData  :video="v"/>
            <AllowVideo :id="v.hash_id" @moderate="VideoModerate" :is_moderated="v.is_moderated" />
            <ChangeStatus :id="v.hash_id" :statusvideo="v.ban_status_id" @ChangeStatus="allowVideo"/>
        </div>
        <h1 v-if="videos.length===0" class="text-4xl">
            Ничего не найдено
        </h1>
    </div>

</template>
<script setup>
import VideoAdminData from "@/components/Admin/VideoAdminData.vue";
import AllowVideo from "@/components/Admin/AllowVideo.vue";
import {useAdminStore} from "@/js/store/admin";
import ChangeStatus from "@/components/Admin/ChangeStatus.vue";
const props = defineProps({
    videos: Array,
});
const adminStore = useAdminStore();

const VideoModerate = (hash_id) => {
    adminStore.moderateVideo(hash_id);
}
const allowVideo = (hash_id, status) => {
    adminStore.changeStatus(hash_id, status);
}
</script>
