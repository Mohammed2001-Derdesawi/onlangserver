require('./bootstrap');
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'


import Vue from 'vue'
import inbox from './components/messages/inbox.vue'
import chat from './components/messages/chat.vue'
import textareavue from './components/messages/textareavue.vue'
// import tinymce from 'vue-tinymce-editor'
import TinymceEditor  from 'vue-tinymce-editor'

Vue.use(BootstrapVue)
Vue.component('inbox', inbox)
Vue.component('chat', chat)
Vue.component('textareavue', textareavue)
// Vue.component('tinymce',tinymce)
 Vue.component('tinymce',TinymceEditor)
const app = new Vue({
    el: '#app',
});
