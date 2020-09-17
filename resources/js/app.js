require('./bootstrap');
window.Vue = require('vue');
//moment js
import moment from 'moment';
Vue.filter('timeformat',(arg) =>{
   return moment(arg).format("MMM Do YYYY");
});
//vue ex
import Vuex from 'vuex'
Vue.use(Vuex);
import storeData from './store/index'
const store = new Vuex.Store(
    storeData
);
//sweet alert
import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
window.Toast = Toast;
//v-form
import { Form, HasError, AlertError } from 'vform';
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
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
    router,
    store
});
