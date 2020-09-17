import Vue from 'vue';
import moment from 'moment';
Vue.filter('timeformat',(arg) =>{
    return moment(arg).format("MMM Do YYYY");
});