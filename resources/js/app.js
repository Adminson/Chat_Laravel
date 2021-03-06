/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('chat-component', require('./components/ChatComponent.vue').default);
Vue.component('admin-vote-component', require('./components/AdminVoteComponent.vue').default);
Vue.component('vote-component', require('./components/VoteComponent.vue').default);
// Vue.component('message-component', require('./components/message.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import 'v-toaster/dist/v-toaster.css'
import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)
 
import Toaster from 'v-toaster'
Vue.use(Toaster, {timeout: 5000})

const app = new Vue({
    el: '#app',
});
