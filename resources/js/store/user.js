import { defineStore } from "pinia";
import {ref} from "vue";

export const useUserStore = defineStore("user", {
    state: () => ({
        user: ref({}),
    }),
    persist: true,
    actions: {
        async fetchUser() {
            if(!localStorage.getItem('user_token')) {
                return;
            }
            const res = await axios.get("/api/user/me",
                {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('user_token')}`
                    }
                }
            );
            const user = res.data.data;
            this.user = user;
        },
        async createVideo(data) {
            const res = await axios.post('/api/videos', {
                ...data
            },
                {
                    headers: {
                        'Content-type': 'multipart/form-data',
                        'Authorization': `Bearer ${localStorage.getItem('user_token')}`
                    }
                }
                );
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
