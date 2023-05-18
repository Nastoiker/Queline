import { defineStore } from "pinia";

export const useUserStore = defineStore("user", {
    state: () => ({
        user: ref({}),
    }),

    actions: {
        async fetchUser() {
            const res = await fetch("https://localhost:3000/user");

            const user = await res.json();
            this.user = user;
        },
        async createVideo(data) {
            const res = await axios.post('/api/videos', {
                ...data
            });
            this.user = user;
        },
        async likeVideo(data) {
            const res = await axios.post('/api/videos', {
                ...data
            });
            this.user = user;
        },
        async unLikeVideo(data) {
            const res = await axios.post('/api/videos', {
                ...data
            });
            this.user = user;
        },
        async deleteVideo(data) {
            const res = await axios.post('/api/videos', {
                ...data
            });
        },
        async followChannel(data) {
            const res = await axios.post('/api/videos', {
                ...data
            });
        },
    }
});
