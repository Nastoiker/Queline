import {createRouter, createWebHistory} from "vue-router";
import {useUserStore} from "@/js/store/user";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: "/",
            name: "main",
            component: () => import('@/Pages/Home.vue')
        },
        {
            path: "/home",
            name: "home",
            component: () => import('@/Pages/Home.vue')
        },
        {
            path: "/login",
            name: "login",
            component: () => import('@/Pages/Login.vue')
        },
        {
            path: "/register",
            name: "register",
            component: () => import('@/Pages/Register.vue')
        },
        {
            path: "/profile/editProfile",
            name: "editProfile",
            meta: {
                requiresAuth: true,
            },
            component: () => import('@/Pages/editProfile.vue'),
        },
        {
            path: "/profile/createVideo",
            name: "create_video",
            meta: {
                requiresAuth: true,
            },
            component: () => import('@/Pages/CreateVideo.vue'),
        },
        {
            path: "/founded/:value",
            name: "founded",
            component: () => import('@/Pages/SearchPage.vue'),
        },
        {
            path: "/video/:hash_id",
            name: "videoPage",
            component: () => import('@/Pages/VideoPage.vue'),
        },
        {
            path: "/category/:category_Id",
            name: "categoryPage",
            component: () => import('@/Pages/CategoryPage.vue'),
        },
        {
            path: "/@:nickname",
            name: "channel",
            component: () => import('@/Pages/Channel.vue'),
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
            component: () => import('@/Pages/Profile.vue'),
        },
        {
            path: '/:pathMatch(.*)*',
            name: 'NotFound',
            component: () => import('@/Pages/NotFound.vue')
        }
    ],
});
router.beforeEach(async (to, from, next) => {
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
