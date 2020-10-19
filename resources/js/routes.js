import list from './components/TheList.vue'
import registration from './components/pages/Registration.vue'
import login from './components/pages/Login.vue'
import productListing from './components/pages/ProductListing.vue'
import cart from './components/pages/Cart.vue'
import home from './components/pages/Home.vue'

export default [
  {
    path: '/',
    component: home
  },
  {
    path: '/products',
    component: productListing,
    props: true,
    name: 'productListing'
  },
  {
    path: '/registration',
    component: registration
  },
  {
    path: '/login',
    component: login
  },
  {
    path:'/cart/:currentUserID',
    component: cart,
    props: true,
    name: 'cartAndHistory'
  }
]