import { defineStore } from "pinia";
import {ref} from "vue";
import router from "../route/index";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        user:  ref({}),
        message: ref("")
    }),
    getters: {
        userFirstName: (state) => {
            if (state.user.login) {
                return (
                    state.user.login
                );
            }
        }
    },
    actions: {
        async signUp(login, password) {
            const res = await fetch("https://localhost:3000/register", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ email, password }),
            });
            const user = await res.json()
            this.user = user;
            router.push('/')
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
            router.push('/')
        },
        logout() {
            this.$reset();
            router.push('/');
        }
    },
    greeting: {
        enabled: true,
    },
    persist: true,
});
