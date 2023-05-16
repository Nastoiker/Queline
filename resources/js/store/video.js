import {defineStore} from "pinia";
const url = "";
interface Video {
}
export const useVideoStore = defineStore("videoStore", {
    state: () => ({

    }),
    actions: {
        async getAllVideo() {
            const res = await fetch(`${url}$`);
        }
    }
})
