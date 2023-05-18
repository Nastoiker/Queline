import {defineStore} from "pinia";
import {ref} from "vue";
const url = "";

export const useVideoStore = defineStore("videoStore", {
    state: () => ({
        video: ref({});
    }),
    actions: {
        async getAllVideo() {
            const res = await axios.get('/api/videos');
            this.video = res.data;
        }
    }
})
