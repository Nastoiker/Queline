import {defineStore} from "pinia";
import {ref} from "vue";
import axios from "axios";
import {aw} from "../../../public/build/assets/app-041cbd2e";

const url = "";

export const useVideoStore = defineStore("videoStore", {
    state: () => ({
        video: ref({}),
        categories: ref({}),
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
        async deleteVideo(data) {
            const res = await axios.post('/api/videos', {
                ...data
            });
        },
        async getAllVideo() {
            const res = await axios.get('/api/videos');
            this.video = res.data.data;
        },

        async getVideo(hash_id) {
            const res = await axios.get(`/api/videos/${hash_id}`);
            const comment = await axios.get(`/api/videos/${hash_id}/comments`);
            this.currentVideo = res.data.data;
            this.currentVideo.comments = comment.data.data;
        },
        async getCommentsVideo(hash_id) {
            const res = await axios.get(`/api/videos/${hash_id}/comments`);
            this.currentVideo.comments = res.data.data;
        },
        async getCategories() {
            const res = await axios.get('/api/categories');
            this.categories =  res.data.data;
        },
        async getVideoByCategory(category) {
            const res = await axios.get(`/api/category/${category}/videos`);
            this.videoByCategory = res.data.data;
        },
        async setLike(hash_id) {
            const res = await axios.post(`/api/videos/${hash_id}/grade`, {
                grade_status: 1
            }, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('user_token')}`
                }
            });
            await this.getVideo(hash_id);
        },
        async setDislike(hash_id) {
            const res = await axios.post(`/api/videos/${hash_id}/grade`, {
                grade_status: 2
            }, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('user_token')}`
                }
            });
            await this.getVideo(hash_id);
        },
        async pushComment(text, hash_id, re_id = null) {
            const commentData = {'text': text};
            if (re_id) {
                commentData.re_id = re_id;
            }
            const res = await axios.post(`/api/videos/${hash_id}/comments`, commentData, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('user_token')}`
                }
            });
            await this.getCommentsVideo(hash_id);
        },
        async setCommentGrade(id, grade_status, hash_id) {
            const res = await axios.post(`/api/comments/${id}/grade`, {
                grade_status_id: grade_status
            }, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('user_token')}`
                }
            });
            await this.getCommentsVideo(hash_id);
        }
    }
})
