import {defineStore} from "pinia";

export const useAppStore = defineStore(
    {
        state: () => ({
            channel: '',
            followers: '',
        }),
        getters: {},
        actions: {

            async fetchUser(nickname) {

                const res = await axios.get(`/api/${nickname}/subscribers`,

                );
                const followers = res.data.data;
                this.followers = followers;
            },
        },
    },
);
