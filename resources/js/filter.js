import Vue from 'vue';
import moment from 'moment';
Vue.filter('timeformat',(arg) =>{
    return moment(arg).format("MMM Do YYYY");
});
Vue.filter('shortLength',(text,length,suffix) =>{
    if(text.length > length){
        return text.substr(0,length)+suffix;
    }
    else{
        return text.substr(0,length);
    }
});