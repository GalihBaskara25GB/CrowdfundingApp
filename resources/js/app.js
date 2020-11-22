import Vue from 'vue'
import router from './router.js'
import store from './counterDonations'
import App from './App.vue'
import vuetify from './plugins/vuetify.js'
import './bootstrap.js'

const app = new Vue({
    el: '#app',
    router,
    store,
    vuetify,
    components: {
        App
    }
})