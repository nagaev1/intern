<script setup>
import Layout from '@/Layouts/Layout.vue'
import { ref, onMounted, inject } from 'vue'
import Post from '@/components/Post.vue'
import PostForm from '@/components/PostForm.vue'

const props = defineProps({
  userName: {
    type: String,
    required: true,
  },
})

const posts = ref([])
const postsPlugin = inject('postsPlugin')

onMounted(async () => {
  updatePosts()
})

const updatePosts = async () => {
  const res = await postsPlugin.getUserPosts(props.userName)
  console.log(res)
  posts.value = res.data
}
</script>
<template>
  <Layout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ props.userName }} Posts</h2>
    </template>

    <!-- Post form -->
    <section class="my-10 container mx-auto" v-if="$auth.user()">
      <PostForm @submit="updatePosts" />
    </section>

    <!-- Posts list -->
    <section class="container mx-auto space-y-9 my-10">
      <Post v-for="post in posts" :post />
    </section>
  </Layout>
</template>
