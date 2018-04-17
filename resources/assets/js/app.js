require('./bootstrap');

Vue.component('thread-view', require('./pages/Thread.vue'));

Vue.component('flash', require('./components/Flash.vue'));
Vue.component('paginator', require('./components/Paginator'));
Vue.component('user-notifications', require('./components/UserNotifications'));

const app = new Vue({
    el: '#app'
});
