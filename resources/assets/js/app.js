require('./bootstrap');

window.Vue = require('vue');

Vue.component('reply', require('./components/Reply.vue'));
Vue.component('favorite', require('./components/Favorite.vue'));


const app = new Vue({
    el: '#app'
});
