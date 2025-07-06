import axios from 'axios'
export default {
  install: (app, options) => {
    async function upload(values) {
      const token = localStorage.getItem('token')
      if (!token) {
        throw { message: 'Unauthenticated' }
      }
      const res = await axios.post('http://localhost:8000/api/posts', values, {
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
        `http://localhost:8000/api/user/${userId}/subscribe`,
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

    async function getAll() {
      return await get('http://localhost:8000/api/posts')
    }

    async function getUserPosts(userName) {
      return await get('http://localhost:8000/api/posts/' + userName)
    }

    async function getFeed() {
      return await get('http://localhost:8000/api/feed')
    }

    async function getHashtag(hashtag) {
      return await get('http://localhost:8000/api/posts/hash/' + hashtag)
    }

    app.provide('postsPlugin', { upload, getAll, getUserPosts, subscribe, getFeed, getHashtag })
  },
}
