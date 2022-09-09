
require('./bootstrap');

window.Vue = require('vue');



Vue.component('chats-component', require('./components/CatsComponent.vue').default);

// window.EventBus = new Vue();

const app = new Vue({
    el: '#app',
});
