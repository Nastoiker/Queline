import './bootstrap';
import { createApp } from 'vue/dist/vue.runtime.esm-bundler';
import App from "../components/App.vue";
import router from "./route/index";
import {createPinia} from "pinia";
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
import dayjs from 'dayjs'
const pinia = createPinia();
const app = createApp(App);
app.config.globalProperties.$dayjs = dayjs
pinia.use(piniaPluginPersistedstate);

app.use(pinia).use(router).mount('#app');
