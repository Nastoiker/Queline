import {defineStore} from "pinia";
import {ref} from "vue";
const url = "";

export const useVideoStore = defineStore("videoStore", {
    state: () => ({
        video: ref({}),
        categories: ref([{
            title: 'asdasdas',
        }]),
        loaded: ref(Boolean),
        videoByCategory: ref({}),
        currentCategory: ref({}),
        currentVideo: ref({}),
    }),
    getters: {
        returnCategories() {
            return this.categories;
        },
    },
    actions: {
        async getVideoUser(nickname) {
            this.loaded = true;
            try {
                const res = await axios.get(`/api/@${nickname}/videos`);
                this.video =  res.data.data;
            } catch {
                this.video = [];
            }
            this.loaded = false;
        },
        async getAllVideo() {
            const res = await axios.get('/api/videos');
            this.video = res.data.data;
        },

        async getVideo(hash_id) {
            const res = await axios.get(`/api/videos/${hash_id}`);
            const comment = await axios.get(`api/videos/${hash_id}/comments`);
            this.currentVideo = res.data.data;
            this.currentVideo.comments = comment.data.data;
        },
        async getCommentsVideo() {
            const res = await axios.get('/api/videos/hash/comments');
            this.currentVideo.comments = res.data;
        },
        async getCategories() {
            const res = await axios.get('/api/categories');
            const category =  res.data.data;
            console.log(category);
            this.categories =  category;
        },
        async getVideoByCategory(category) {
            const res = await axios.get(`/api/category/${category}/videos`);
            this.videoByCategory = res.data.data;
        },

    }
})
