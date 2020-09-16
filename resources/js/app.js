require('./bootstrap');
window.Vue = require('vue');
//vue router
import VueRouter from 'vue-router'
Vue.use(VueRouter);
import {routes} from './routes';
const router = new VueRouter({
    routes,
    mode: 'history'
});
//admin master
Vue.component('admin-master', require('./components/admin/AdminMaster').default);
const app = new Vue({
    el: '#app',
    router
});
