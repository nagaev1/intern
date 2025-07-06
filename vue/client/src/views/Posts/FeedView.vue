<script setup>
import Layout from '@/Layouts/Layout.vue'
import { ref, onMounted, inject } from 'vue'
import Post from '@/components/Post.vue'
import PostForm from '@/components/PostForm.vue'

const posts = ref([])
const postsPlugin = inject('postsPlugin')

const updatePosts = async () => {
  const res = await postsPlugin.getFeed()
  console.log(res)
  posts.value = []
  posts.value = res.data
}

onMounted(async () => {
  updatePosts()
})
</script>
<template>
  <Layout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Feed</h2>
    </template>

    <!-- Post form -->
    <section class="my-10 container mx-auto" v-if="$auth.user()">
      <PostForm @submit="updatePosts" />
    </section>

    <!-- Posts list -->
    <section class="container mx-auto space-y-9 my-10">
      <Post v-for="post in posts" :post @subscribed="updatePosts" />
    </section>
  </Layout>
</template>
