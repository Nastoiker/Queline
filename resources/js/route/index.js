import Home from "../../Pages/Home.vue";
import Login from "../../Pages/Login.vue";
import Register from "../../Pages/Register.vue";
import {createRouter, createWebHistory} from "vue-router";


const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: Home},
        { path: "/login", component: Login},
        { path: "/register", component: Register}
    ]
});
console.log(router.getRoutes());
export default router;
