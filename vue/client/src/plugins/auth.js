import axios from 'axios'
export default {
  install: (app, options) => {
    async function login(values) {
      const res = await axios.post('/api/login', values)
      localStorage.setItem('token', res.data.token)
      localStorage.setItem('user', JSON.stringify(res.data.user))
      return res
    }

    async function register(values) {
      const res = await axios.post('/api/register', values)
      console.log(res);
      localStorage.setItem('token', res.data.token)
      localStorage.setItem('user', JSON.stringify(res.data.user))
      return res
    }

    function user() {
      return JSON.parse(localStorage.getItem('user') || 'null')
    }

    function token() {
      return JSON.parse(localStorage.getItem('token') || 'null')
    }

    function logout() {
      localStorage.setItem('token', '')
      localStorage.setItem('user', '')
    }

    app.provide('auth', { login, user, token, logout, register })
    app.config.globalProperties.$auth = { user, token, logout }
  },
}
