import {defineStore} from "pinia";
import {ref} from "vue";
const url = "";

export const useVideoStore = defineStore("videoStore", {
    state: () => ({
        video: ref({}),
        currentVideo: ref({}),
    }),
    actions: {
        async getAllVideo() {
            const res = await axios.get('/api/videos');
            this.video = res.data;
        },
        async getVideo() {
            const res = await axios.get('/api/videos/hash');
            this.currentVideo = res.data;
        },
        async getCommentsVideo() {
            const res = await axios.get('/api/videos/hash/comments');
            this.currentVideo.comments = res.data;
        }
    }
})
