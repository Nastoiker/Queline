import { defineStore } from "pinia";
import {ref} from "vue";

export const useAdminStore = defineStore("user", {
    state: () => ({
        admin: ref({}),
        videos: ref({}),
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
            const admin = res.data.data;
            if(admin.role) {
                this.admin = admin;
            } else {
                return
            }
        },
        async getVideos(data) {
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
            this.videos = res.data.data;
        },
        async createAdmin(user) {
            await axios.put(`/api/videos/@${user}/make-admin`, {
                _method: 'PUT',
            })
        },
        async moderateVideo(videoId) {
            const video = await axios.put(`/api/videos/${videoId}/moderate`, {
                _method: 'PUT',
            })
        }
    }
});
