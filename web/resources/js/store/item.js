import { OK, CREATED, UNPROCESSABLE_ENTITY } from '../util'

const state = {
  items: null,
  currentPage: null,
  lastPage: null,
  apiStatus: null,
  errorMessages: null
}

const getters = {
}

const mutations = {
  setItems (state, items) {
    state.items = items
  },
  setCurrentPage (state, currentPage) {
    state.currentPage = currentPage
  },
  setLastPage (state, lastPage) {
    state.lastPage = lastPage
  },
  setApiStatus (state, status) {
    state.apiStatus = status
  },
  setErrorMessages (state, messages) {
    state.errorMessages = messages
  }
}

const actions = {
  async fetchItems ({ commit }) {
    const response = await axios.get(`/api/items/?page=${this.page}`)

    if (response.status === OK) {
      commit('setApiStatus', true)
      commit('setItems', response.data.data)
      commit('setCurrentPage', response.data.current_page)
      commit('setLastPage', response.data.last_page)
      return false
    }

    commit('setApiStatus', false)
    commit('error/setCode', response.status, { root: true })
  },
  // 会員登録
  async editItem ({ commit, dispatch }, { item }) {
    commit('setApiStatus', null)
    const response = await axios.post('/api/item/edit', item)

    if (response.status === OK) {
      commit('setApiStatus', true)
      await dispatch('fetchItems')
      return false
    }

    commit('setApiStatus', false)
    commit('error/setCode', response.status, { root: true })
  },
  async addItem ({ commit, dispatch }, { item }) {
    commit('setApiStatus', null)
    const response = await axios.post('/api/item/add', item)

    if (response.status === OK) {
      commit('setApiStatus', true)
      await dispatch('fetchItems')
      return false
    }

    commit('setApiStatus', false)
    commit('error/setCode', response.status, { root: true })
  },
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
