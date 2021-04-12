import Vue from 'vue';
import Router from 'vue-router';
import Dashboard from '../components/Dashboard.vue'
import Profile from '../components/Profile.vue'
import Tables from '../components/Tables.vue'
import Products from '../components/Products.vue'
import Maps from '../components/Maps.vue'
import BadGateway from '../components/BadGateway.vue'
import AddProduct from '../components/AddProduct.vue'
import Register from '../components/Register.vue'
import Login from '../components/Login.vue'


Vue.use(Router);

export default new Router({
  // mode: 'history',
  routes: [
    {
      path: '/dashboard',
      name: 'Dashboard',
      component: Dashboard,
      props: { page: 1 }
    },
    {
      path: '/profile',
      name: 'Profile',
      props: { page: 2 },
      component: Profile
    },
    {
      path: '/tables',
      name: 'Tables',
      props: { page: 3 },
      component: Tables
    },
    {
      path: '/maps',
      name: 'Maps',
      props: { page: 4 },
      component: Maps
    },
    // {
    //   path: '/404',
    //   name: 'BadGateway',
    //   props: { page: 5 },
    //   component: BadGateway
    // },
    // {
    //   path: '*',
    //   props: { page: 5 },
    //   redirect: '/404'
    // },
    {
      path: '/dashboardTwo',
      name: 'Dashboard Two',
      component: Dashboard,
      props: { page: 6 }
    },
    {
      path: '*',
      redirect: '/dashboard',
      name: 'Home'
    },
    {
      path: '/product',
      name: 'Products',
      props: { page: 8 },
      component: Products
    }
    ,
    {
      path: '/addProduct',
      name: 'Add Product',
      props: { page: 9 },
      component: AddProduct
    },
    {
      path: '/editProduct',
      name: 'Edit Product',
      props: { page: 12 },
      component: AddProduct
    },
    {
      path: '/register',
      name: 'Register',
      component: Register,
      props: { page: 10 }
    },
    {
      path: '/login',
      name: 'Login',
      component: Login,
      props: { page: 11 }
    },
    
  ]
})