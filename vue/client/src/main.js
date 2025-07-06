import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import auth from './plugins/auth'
import postsPlugin from './plugins/postsPlugin'
const app = createApp(App)

app.use(auth)
app.use(postsPlugin)
app.use(router)
app.mount('#app')
