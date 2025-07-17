import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import auth from './plugins/auth'
import postsPlugin from './plugins/postsPlugin'
import { createStore } from 'vuex'
const app = createApp(App)

app.use(auth)
app.use(postsPlugin)
app.use(router)

const store = createStore({
  state: {
    subscriptions: [],
  },
  mutations: {
    SET_SUBSCRIPTIONS(state, payload) {
      state.subscriptions = payload.subscriptions
    },
  },
  actions: {
    async UPDATE_SUBSCRIPTIONS({ commit }) {
      const { data } = await app.config.globalProperties.$postPlugin.getSubscriptions()
      commit('SET_SUBSCRIPTIONS', { subscriptions: data })
    },
  },
})

app.use(store)
app.mount('#app')
