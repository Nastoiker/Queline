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
        async signUp(email: string, password: string) {
            const res = await fetch("https://localhost:3000/register", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ email, password }),
            });
            const user = await res.json()
            this.user = user;
        },
        async signIn(email: string, password: string) {
            const res = await fetch("https://localhost:3000/register", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ email, password }),
            });
            const user = await res.json();
            this.user = user;
        },
    },
});
