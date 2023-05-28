import {defineStore} from "pinia";
import {ref} from "vue";

export const useChannelStore = defineStore(
    'app',
    {
        state: () => ({
            subs: ref({});
        }),
        getters: {},
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
            async getSubs(nickname) {
                const res = await axios.get(`/api/@${nickname}/subscribers`);
                this.subs = res.data;
            }
        },
    },
);
