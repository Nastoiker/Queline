import {defineStore} from "pinia";

export const useAppStore = defineStore(
    'app',
    {
        state: () => ({
            theme: '',
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
        },
    },
);
