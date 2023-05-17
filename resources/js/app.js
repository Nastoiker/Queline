import './bootstrap';
import { createApp } from 'vue/dist/vue.runtime.esm-bundler';
import App from "../components/App.vue";
import router from "./route/index";
import {createPinia} from "pinia";
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
const pinia = createPinia();
const app = createApp(App);
pinia.use(piniaPluginPersistedstate);
app.use(router).use(pinia).mount('#app');
