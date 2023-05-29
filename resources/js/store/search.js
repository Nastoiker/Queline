import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";

export const useSearchStore = defineStore('search', {
    state: () => ({
        founded: ref({}),
    }),
    actions: {
        async getFounded(search) {
            const res = await axios.get(`/api/search?q={${search}}`);
            this.founded = res.data;
        },
    },
});
