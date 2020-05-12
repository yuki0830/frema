const state = {
  modalName: '',
  item: null
}

const mutations = {
  setModal (state, name) {
    state.modalName = name
  },
  hideModal (state) {
    state.modalName = ''
  },
  setItem (state, item) {
    state.item = item
  },
}

const actions = {
  showModalTypeA ({ commit }) {
    commit('setModal', 'ModalTypeA')
  },
  showModalTypeB ({ commit }) {
    commit('setModal', 'ModalTypeB')
  },
  showEditItem({ commit }, { item }) {
    commit('setModal', 'EditItem')
    commit('setItem', item)
  },
  showAddItem({ commit }) {
    commit('setModal', 'AddItem')
  }
}

export default {
  namespaced: true,
  state,
  mutations,
  actions
}