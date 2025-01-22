import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "./Pages/Dashboard.vue";
import Index from "./Pages/Techniques/Index.vue";
import Login from "./Components/Login.vue";
import Register from "./Components/Register.vue";

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
    },
    {
        path: "/register",
        name: "Register",
        component: Register,
        meta: {requiresAuth: false}
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("auth_token");
    const isAuthenticated = !!token;

    if (to.matched.some((record) => record.meta.requiresAuth) && !isAuthenticated) {
        return next("/login");
    } 
    if (to.path === "/login" && isAuthenticated) {
        return next("/dashboard");
    }
    next();
});

export default router;