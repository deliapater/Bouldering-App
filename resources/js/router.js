import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "./Pages/Dashboard.vue";
import Index from "./Pages/Techniques/Index.vue";
import Login from "./Components/Login.vue";

const routes = [
    {
        path: "/",
        name: "Dashboard",
        component: Dashboard,
    },
    {
        path: "/techniques",
        name: "Techniques",
        component: Index,
    },
    {
        path:"/login",
        name:"Login",
        component: Login
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = !!localStorage.getItem("auth_token");

    if (to.matched.some((record) => record.meta.requiresAuth) && !isAuthenticated) {
        next("/login");
    } else {
        next();
    }
});

export default router;