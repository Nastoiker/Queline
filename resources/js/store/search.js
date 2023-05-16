import {defineStore} from "pinia";

export const useVideoStore = defineStore("videoStore", {
    state: () => ({

    }),
    actions: {
        async getAllVideo(search) {
            const res = await fetch(`${url}${}`);
        }
    }
})
