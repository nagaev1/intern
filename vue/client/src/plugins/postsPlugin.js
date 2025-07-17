import axios from 'axios'
export default {
  install: (app, options) => {
    async function upload(values) {
      const token = localStorage.getItem('token')
      if (!token) {
        throw { message: 'Unauthenticated' }
      }
      const res = await axios.post('/api/posts', values, {
        headers: {
          Authorization: 'Bearer ' + token,
        },
      })
      return res
    }

    async function subscribe(userId) {
      const token = localStorage.getItem('token')
      if (!token) {
        throw { message: 'Unauthenticated' }
      }

      const res = await axios.post(
        `/api/user/${userId}/subscribe`,
        {},
        {
          headers: {
            Authorization: 'Bearer ' + token,
          },
        },
      )

      return res
    }

    async function get(url, params = {}) {
      const token = localStorage.getItem('token')
      const res = await axios.get(url, {
        headers: {
          ...(token ? { Authorization: 'Bearer ' + token } : {}),
        },
        ...(params ? { params } : {}),
      })
      return res
    }

    async function getSubscriptions() {
      return await get('/api/subscriptions')
    }

    async function getAllPosts(page = 1) {
      return await get('/api/posts', { page })
    }

    async function getUserPosts(userName, page = 1) {
      return await get('/api/posts/' + userName, { page })
    }

    async function getFeedPosts(page = 1) {
      return await get('/api/feed', { page })
    }

    async function getHashtagPosts(hashtag, page = 1) {
      return await get('/api/posts/hash/' + hashtag, { page })
    }

    const postPlugin = {
      upload,
      getAllPosts,
      getUserPosts,
      subscribe,
      getFeedPosts,
      getHashtagPosts,
      getSubscriptions,
    }

    app.provide('postsPlugin', postPlugin)
    app.config.globalProperties.$postPlugin = postPlugin
  },
}
