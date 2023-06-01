import {defineStore} from "pinia";
import {ref} from "vue";

export const useChannelStore = defineStore(
    'app',
    {
        state: () => ({
            subscribers: ref({}),
            subscribes: ref({}),
            channel: ref({})
        }),
        getters: {

        },
        actions: {
            toggleTheme(dark) {
                if (dark) {
                    this.theme = 'dark';
                    document.documentElement.classList.add('dark');
                } else {
                    this.theme = 'light';
                    document.documentElement.classList.remove('dark');
                }
            },
            async getSubscribers(nickname) {
                const res = await axios.get(`/api/@${nickname}/subscribers`);
                this.subscribers = res.data.data;
            },
            async getChannel(nickname) {
                const res = await axios.get(`/api/@${nickname}`);
                this.channel = res.data.data;
            },
            async getSubscribes(nickname) {
                const res = await axios.get(`/api/@${nickname}/subscribes`);
                this.subscribes = res.data.data;
            }
        },
    },
);
