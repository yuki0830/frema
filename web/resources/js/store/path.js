import consts from '../consts'

const state = {
  path: null
}

const getters = {
  floatButton: state => {
    switch (state.path) {
      case consts.Pages.HOME:
        return "plus";
      case consts.Pages.ITEMS:
        return "plus";
      default:
        return "plus";
    }
  }
}

const mutations = {
  setPath (state, path) {
    state.path = path
  }
}

const actions = {
  setPath ({ commit }, { path }) {
    commit('setPath', path);
  },
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
