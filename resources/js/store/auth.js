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
        async signUp(data) {
            const res = await axios.post("api/register", {
                    ...data
                },
                {
                    headers: {
                        'Content-type': 'multipart/form-data',
                    }
                }
            );
            const user =  res.data;
            localStorage.setItem('user_token', user.user_token);
            this.user = user;
            console.log(user);
            router.push(this.returnUrl || '/');
        },
        async signIn(data) {
            const res = await axios.post("/api/login", {
                ...data
            },

                {
                    headers: {
                        'Content-type': 'application/json',
                    }
                }
            );
            const user = res.data;
            this.user = user;
            localStorage.setItem('user_token', user.user_token);
            router.push(this.returnUrl || '/');
        },
        logout() {
            this.user = null;
            localStorage.removeItem('user');
            this.$reset();
            localStorage.removeItem('nickname');
            router.push('/home');
        }
    },
    greeting: {
        enabled: true,
    },
    persist: true,
});
