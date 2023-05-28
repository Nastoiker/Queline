import { defineStore } from "pinia";
import {ref} from "vue";

export const useAdminstore = defineStore("user", {
    state: () => ({
        user: ref({}),
    }),
    persist: true,
    actions: {
        async fetchAdmin() {
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

        async deleteVideo(data) {
            const res = await axios.post('/api/videos', {
                ...data
            });
        },
        async moderateVideo(videoId) {
            const video = await axios.put('/api/videos/hash/moderate', {
                videoId
            })
        }
    }
});
