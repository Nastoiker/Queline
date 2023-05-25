import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";

export const useSearchStore = defineStore("videoStore", {
    state: () => ({
        founded: ref({}),
    }),
    actions: {
        async getAllVideo(search) {
            const res = await axios.get(`${url}$`);
            this.founded = res.data.data;
        },
    },
});
