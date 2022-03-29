import { createWebHistory, createRouter } from "vue-router";
import Home from "./Vue/Home";
import Login from "./Vue/Login";
import Register from "./Vue/Register";
import CartPage from "./Vue/CartPage";
import Orders from "./Vue/Orders";
import OrderPage from "./Vue/OrderPage";
import HistoryPage from "./Vue/HistoryPage";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
        alias: '/home'
    },
    {
        path: "/login",
        name: "Login",
        component: Login
    },
    {
        path: "/register",
        name: "Register",
        component: Register
    },
    {
        path: "/my-cart",
        name: "Cart Page",
        component: CartPage
    },
    {
        path: '/orders/',
        name: 'orders',
        component: Orders
    },
    {
        path: "/order/:order_id",
        name: "order",
        component: OrderPage
    },
    {
        path: "/history",
        name: "history",
        component: HistoryPage
    },
    {
        path: "/:catchAll(.*)",
        name: "Not Found",
        component: Home,
        meta: {
            requiresAuth: false
        }
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, from) => {
    let isAuthenticated = window.auth_user != null;

    await axios.get("/api/auth").then((response) => {
        window.auth_user = response.data;
        isAuthenticated = true;
    }).catch((e) => {
        isAuthenticated = false;
    })

    if (
        // make sure the user is authenticated
        !isAuthenticated &&
        // ❗️ Avoid an infinite redirect
        to.name !== 'Login' && to.name !== "Register"
    ) {
        // redirect the user to the login page
        return { path: "/login" }
    } else if ((isAuthenticated) &&
        (to.name === "Login" || to.name === "Register")) {
        return { path: "/"}

    }
})

export default router;
