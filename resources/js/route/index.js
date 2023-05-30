import Home from "../../Pages/Home.vue";
import Login from "../../Pages/Login.vue";
import Register from "../../Pages/Register.vue";
import { createRouter, createWebHistory } from "vue-router";
import Profile from "../../Pages/Profile.vue";
import CreateVideo from "../../Pages/CreateVideo.vue";
import editProfile from "@/Pages/editProfile.vue";
import SearchPage from "@/Pages/SearchPage.vue";
import {useUserStore} from "@/js/store/user";
import VideoPage from "@/Pages/VideoPage.vue";
import CategoryPage from "@/Pages/CategoryPage.vue";
const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        { path: "/", name: "main", component: Home },
        { path: "/home", name: "home", component: Home },
        { path: "/login", name: "login", component: Login },
        { path: "/register", name: "register", component: Register },
        {
            path: "/profile/editProfile",
            name: "editProfile",
            meta: {
                requiresAuth: true,
            },
            component: editProfile,
        },
        {
            path: "/profile/createVideo",
            name: "create_video",
            meta: {
                requiresAuth: true,
            },
            component: CreateVideo,
        },
        {
            path: "/founded/:value",
            name: "founded",
            component: SearchPage,
        },
        {
            path: "/video/:hash_id",
            name: "videoPage",
            component: VideoPage,
        },
        {
            path: "/category/:category_Id",
            name: "categoryPage",
            component: CategoryPage,
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
        {
            path: '/:pathMatch(.*)*',
            name: 'NotFound',
            component: () => import('@/Pages/NotFound.vue')
        }
    ],
});
router.beforeEach( async (to, from, next) => {
    const user = useUserStore()
     await user.fetchUser();
    if (to.matched.some((route) => route.meta?.requiresAuth)) {
        if (!user.user.email) {
            next("/home");
        } else {
            next();
        }
    } else {
        next();
    }

});
console.log(router.getRoutes());
export default router;
