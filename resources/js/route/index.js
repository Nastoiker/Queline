import Home from "../../Pages/Home.vue";
import Login from "../../Pages/Login.vue";
import Register from "../../Pages/Register.vue";
import { createRouter, createWebHistory } from "vue-router";
import Profile from "../../Pages/Profile.vue";
import CreateVideo from "../../Pages/CreateVideo.vue";
import editProfile from "@/Pages/editProfile.vue";
import SearchPage from "@/Pages/SearchPage.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        { path: "/", name: "home", component: Home },
        { path: "/home", name: "home", component: Home },
        { path: "/login", name: "login", component: Login },
        { path: "/register", name: "register", component: Register },
        {
            path: "/profile/editProfile",
            name: "editProfile",
            component: editProfile,
        },
        {
            path: "/profile/createVideo",
            name: "create_video",
            component: CreateVideo,
        },
        {
            path: "/profile/createVideo",
            name: "create_video",
            component: CreateVideo,
        },
        {
            path: "/founded/:value",
            name: "founded",
            component: SearchPage,
        },
        {
            path: "/signout",
            name: "signout",
            beforeEnter: (to, from, next) => {
                next("/");
            },
        },
        {
            path: "/profile",
            name: "profile",
            meta: {
                requiresAuth: true,
            },
            component: Profile,
        },
    ],
});
router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some((record) => record.meta.requiresAuth);
    if (requiresAuth && localStorage.getItem("token")) {
        next("/signin");
    } else {
        next();
    }
});
console.log(router.getRoutes());
export default router;
