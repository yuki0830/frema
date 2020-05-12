import './bootstrap'
import Vue from 'vue'
import VueMq from "vue-mq"
import router from './router'
import store from './store'
import App from './App.vue'
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import '@fortawesome/fontawesome-free/css/all.css'

library.add(fas)

Vue.component('fi', FontAwesomeIcon)

Vue.use(Vuetify);
const vuetifyOptions = { }

Vue.use(VueMq, {
  breakpoints: {
    sm: 450,
    md: 1250,
    lg: Infinity,
  },
  defaultBreakpoint: 'sm'
});

const createApp = async () => {
  await store.dispatch('auth/currentUser')

  new Vue({
    el: '#fremanager',
    router,
    store,
    vuetify: new Vuetify(vuetifyOptions),
    components: { App },
    template: '<App />'
  })
}

createApp()
