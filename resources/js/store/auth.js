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
            this.user = user;
            console.log(user);
            router.push('/')
        },
        async signIn(data) {
            const res = await axios.post("/api/login", {
                data
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
