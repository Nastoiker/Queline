import { defineStore } from "pinia";
import {ref} from "vue";

export const useUserStore = defineStore("user", {
    state: () => ({
        user: ref({}),
        video: ref({}),
        errorCreate: ref("")
    }),
    actions: {
        async getVideoUser() {
            const res = await axios.get(`/api/@${this.user.nickname}/videos`, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('user_token')}`
                }
            });
            console.log(res.data);
            this.user.video =  res.data.data;
        },
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
            try {
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
                this.errorCreate =null;
            } catch (e) {
                this.errorCreate = e.message;
            }

        },
        async likeVideo(data) {
            const res = await axios.post('/api/videos', {
                ...data
            });
            this.user = user;
        },
        async editBanner(data) {
            const res = await axios.post('/api/user/editBanner', {
                ...data
            });
            this.user = user;
        },
        async editAvatar(data) {
            try {
                const res = await axios.post('/api/user/ ', {
                    ...data
                });
            } catch(e) {
                this.error = e.message();
            }

        },
        async editProfile(data) {
            const res = await axios.post(`/api/@${this.user.nickname}`, {
                ...data
            },
                {
                    headers: {
                        'Content-type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${localStorage.getItem('user_token')}`
                    },
                }
                );
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
