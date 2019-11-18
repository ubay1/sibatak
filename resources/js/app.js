import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './router/router'
import App from './components/App'
import VueCarousel from 'vue-carousel'
import store from './store/index.js'
import lodash from 'lodash'
import Toasted from 'vue-toasted';

Vue.use(Toasted)

Vue.prototype._ = lodash

Vue.use(VueCarousel);
// Vue.use(VueLazyload, {
//     preLoad: 1.3,
//     error: './assets/img/loader/404.png',
//     loading: './assets/img/loader/loading.gif',
//     attempt: 5,
//     observer: true
// })

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes
});

router.beforeEach((to, from, next) => {
    if (!to.meta.middleware) {
        return next()
    }
    const middleware = to.meta.middleware

    const context = {
        to,
        from,
        next,
        store
    }
    return middleware[0]({
        ...context
    })
})

const app = new Vue({
    el: '#app',
    components: { App },
    store,
    router,
});
