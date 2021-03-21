import { createRouter, createWebHistory } from "vue-router";
import Cart from "../views/Cart.vue";
import Home from "../views/Home.vue";
import OrderHistory from "../views/OrderHistory.vue";


const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/cart",
    name: "Cart",
    component: Cart,
  },
  {
    path: "/history",
    name: "OrderHistory",
    component: OrderHistory
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
