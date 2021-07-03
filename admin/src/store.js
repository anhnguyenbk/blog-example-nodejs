import Vue from 'vue'
import Vuex from 'vuex'
import StringUtils from './utils/StringUtils'
Vue.use(Vuex)

const ToastType = {
  Error: 1,
  SuccessfullySaved: 2
};

const state = {
  sidebarShow: 'responsive',
  sidebarMinimize: false,
  showErrorToast: false,
  fixedToasts: []
}

const mutations = {
  toggleSidebarDesktop (state) {
    const sidebarOpened = [true, 'responsive'].includes(state.sidebarShow)
    state.sidebarShow = sidebarOpened ? false : 'responsive'
  },
  toggleSidebarMobile (state) {
    const sidebarClosed = [false, 'responsive'].includes(state.sidebarShow)
    state.sidebarShow = sidebarClosed ? true : 'responsive'
  },
  showToast (state, type) {
    var toastId = StringUtils.random(6);
    if (type === ToastType.Error) {
      state.fixedToasts.push({
        id: toastId, 
        header: 'Error', 
        color: 'danger',
        content: 'An unexpected error has occurred. Please try again.'
      })
    } else if (type === ToastType.SuccessfullySaved) {
      state.fixedToasts.push({
        id: toastId, 
        header: 'Successfully saved', 
        color: 'success',
        content: 'The item has been saved successfully.'
      })
    }
  },
  set (state, [variable, value]) {
    state[variable] = value
  }
}

export default new Vuex.Store({
  state,
  mutations,
  getters: {
    ToastType () {
      return ToastType
    }
  }
})