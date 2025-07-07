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

    async function get(url) {
      const token = localStorage.getItem('token')
      const res = await axios.get(url, {
        headers: {
          ...(token ? { Authorization: 'Bearer ' + token } : {}),
        },
      })
      return res
    }

    async function getSubscribtions() {
      return await get('/api/subscriptions')
    }

    async function getAllPosts() {
      return await get('/api/posts')
    }

    async function getUserPosts(userName) {
      return await get('/api/posts/' + userName)
    }

    async function getFeedPosts() {
      return await get('/api/feed')
    }

    async function getHashtagPosts(hashtag) {
      return await get('/api/posts/hash/' + hashtag)
    }

    app.provide('postsPlugin', {
      upload,
      getAllPosts,
      getUserPosts,
      subscribe,
      getFeedPosts,
      getHashtagPosts,
      getSubscribtions,
    })
  },
}
