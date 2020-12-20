//define a routes
function page(path) {
    return () => import(/* webpackChunkName: '' */ `./pages/${path}`).then(m => m.default || m)
}


const routes = [
    {path: '/', name: 'welcome', component: page('Home.vue')},
]


export default routes