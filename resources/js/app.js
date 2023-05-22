import './bootstrap';
import { createApp } from 'vue/dist/vue.runtime.esm-bundler';
import App from "../components/App.vue";
import router from "./route/index";
import {createPinia} from "pinia";
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
import VuePlyr from 'vue-plyr';
import 'vue-plyr/dist/vue-plyr.css';
const pinia = createPinia();
const app = createApp(App);
pinia.use(piniaPluginPersistedstate);

app.use(pinia).use(router).use(VuePlyr).mount('#app');
