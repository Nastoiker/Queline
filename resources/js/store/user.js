import { defineStore } from "pinia";
import {ref} from "vue";

export const useUserStore = defineStore("user", {
    state: () => ({
        user: ref({}),
        video: ref({}),
        errorCreate: ref(""),
        loading: ref(Boolean),
    }),
    getters: {

    },
    actions: {
        checkIsFollow(channelNickname) {
            return Boolean(this.user.subscribes.find( s => s.nickname === channelNickname));
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
            if(!user.nickname) {
                return;
            }
            localStorage.setItem('nickname', user.nickname);
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
            const res = await axios.post('http://queline/api/videos/hash/grade', {
                ...data
            });
        },
        async editBanner(data) {
            const res = await axios.post('/api/user/change/banner', {
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
        async editNickName(nickname) {
            const res = await axios.post('http://queline/api/user/me/banner', {
                ...nickname
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
        async editAvatar(data) {
            try {
                const res = await axios.post('/api/user/change/photo ', {
                    ...data
                },
                    {
                        headers: {
                            'Content-type': 'multipart/form-data',
                            'Authorization': `Bearer ${localStorage.getItem('user_token')}`
                        }
                    }
                );
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
        async deleteVideo(hashId) {
            this.loading = true;
            const res = await axios.post(`/api/videos/${hashId}`, {
                _method: 'DELETE',
            },
                {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${localStorage.getItem('user_token')}`
                    },
                }
                );
            this.loading = false;
        },
        async editVideo(data) {
            const edit = await axios.post('api/videos/hash', {

            })
        },
        async editComment(id, data) {
            const res = await axios.put(`/api/comments/${id}`, {
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
        async followChannel(nickname) {
            const res = await axios.post(`/api/@${nickname}/subscribe`, {
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
    }
});
