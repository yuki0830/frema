import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import error from './error'
import message from './message'
import basicModal from './basicModal'
import multiModal from './multiModal'
import item from './item'
import path from './path'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    auth,
    error,
    message,
    basicModal,
    multiModal,
    item,
    path
  }
})

export default store
