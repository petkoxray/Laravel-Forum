require('./bootstrap');

Vue.component('thread-view', require('./pages/Thread.vue'));
Vue.component('flash', require('./components/Flash.vue'));

const app = new Vue({
    el: '#app'
});
