import './bootstrap';
import { createApp } from 'vue/dist/vue.runtime.esm-bundler';
import App from "../components/App.vue";


const app = createApp(App);

app.mount('#app');
