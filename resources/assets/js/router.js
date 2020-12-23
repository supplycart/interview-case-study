import VueRouter from 'vue-router';

Vue.use(VueRouter);
let routes = [];

export default new VueRouter({
    routes,
    mode: 'history',
    scrollBehavior (to, from, savedPosition) {
        return {x:0, y:0}
    }
})

