import { defineStore } from "pinia";

export const useUserStore = defineStore("user", {
    state: () => ({
        user: null,
    }),

    actions: {
        async fetchUser() {
            const res = await fetch("https://localhost:3000/user");

            const user = await res.json();
            this.user = user;
        },
    }
});
