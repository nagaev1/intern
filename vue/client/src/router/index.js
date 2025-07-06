import { createRouter, createWebHistory } from 'vue-router'
import RegisterView from '@/views/Auth/RegisterView.vue'
import LoginView from '@/views/Auth/LoginView.vue'
import PostsView from '../views/Posts/PostsView.vue'
import UserPostsView from '@/views/Posts/UserPostsView.vue'
import FeedView from '@/views/Posts/FeedView.vue'
import HashtagView from '@/views/Posts/HashtagView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'posts',
      component: PostsView,
    },
    {
      path: '/:userName',
      name: 'userPosts',
      component: UserPostsView,
      props: true,
    },
    {
      path: '/feed',
      name: 'feed',
      component: FeedView,
      meta: {
        auth: true,
      },
    },
    {
      path: '/hash/:hashtagName',
      name: 'hashtag',
      component: HashtagView,
      props: true,
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView,
      meta: {
        guest: true,
      },
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
      meta: {
        guest: true,
      },
    },
  ],
})

router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.auth)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (!localStorage.getItem('user')) {
      next({ name: 'login' })
    } else {
      next() // go to wherever I'm going
    }
    return
  }

  if (to.matched.some((record) => record.meta.guest)) {
    if (localStorage.getItem('user')) {
      next({ name: 'posts' })
    } else {
      next() // go to wherever I'm going
    }
    return
  }

  next()
})

export default router
