import Vue from 'vue'
import router from './router/router'
import App from './components/App'
import VueCarousel from 'vue-carousel'
import store from './store/index.js'
import lodash from 'lodash'
import Toasted from 'vue-toasted';

Vue.prototype._ = lodash
Vue.use(Toasted)
Vue.use(VueCarousel);
// Vue.use(VueLazyload, {
//     preLoad: 1.3,
//     error: './assets/img/loader/404.png',
//     loading: './assets/img/loader/loading.gif',
//     attempt: 5,
//     observer: true
// })

const app = new Vue({
    el: '#app',
    components: { App },
    store,
    router,
});
