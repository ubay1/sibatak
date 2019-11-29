import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store/index.js'

import Login from '../page/Login'
import Daftar from '../page/Daftar'
import Home from '../page/Home'
import About from '../page/About'
import Galeri from '../page/Galeri'

import guest from './middleware/guest'
// import auth from './middleware/auth'
// import middlewarePipeline from './middlewarePipeline'

Vue.use(VueRouter)
// const = 'test_laravel/public/';
const router = new VueRouter({
    mode: 'history',
    base: process.env.MIX_VUE_ROUTER_PATH,
    routes: [
        {
            path : "/login",
            name : 'login',
            component : Login,
            meta:{
                requiresUser: true
            }
        },
        {
            path : "/daftar",
            name : 'daftar',
            component : Daftar,
            meta:{
                requiresUser: true
            }
        },
        {
            path : "/",
            name : 'home',
            component : Home,
            meta: {
                requiresAuth: true
            }
        },
        {
            path : "/about",
            name : 'about',
            component : About,
            meta: {
                requiresAuth: true
            }
        },
        {
            path : "/galeri",
            name : 'galeri',
            component : Galeri,
            meta: {
                requiresAuth: true
            }
        }

    ]
});

router.beforeEach((to, from, next) => {
    store.dispatch('fetchAccessToken');
    if (to.fullPath === '/') {
      if (!store.state.accessToken) {
        next('/login');
      }
    }
    if (to.fullPath === '/about') {
        if (!store.state.accessToken) {
          next('/login');
        }
      }
    if (to.fullPath === '/login') {
      if (store.state.accessToken) {
        next('/');
      }
    }
    next();
})

export default router;
