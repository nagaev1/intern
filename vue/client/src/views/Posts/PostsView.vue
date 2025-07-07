<script setup>
import Layout from '@/Layouts/Layout.vue';
import PostForm from '@/components/PostForm.vue';
import SubscriptionsSideBar from '@/components/SubscriptionsSideBar.vue';
import { inject, onMounted, onUpdated, ref } from 'vue';
import Post from '@/components/Post.vue';
import { useRoute } from 'vue-router'

const route = useRoute()
const postsPlugin = inject('postsPlugin')
const posts = ref([])
const subscribtions = ref([])

const props = defineProps({
  userName: {
    type: String,
    required: false,
  },
  hashtagName: {
    type: String,
    required: false,
  },
})

const updatePosts = async () => {
  switch (route.name) {
    case 'posts':
      posts.value = (await postsPlugin.getAllPosts()).data
      break
    case 'feed':
      posts.value = (await postsPlugin.getFeedPosts()).data
      break
    case 'userPosts':
      posts.value = (await postsPlugin.getUserPosts(props.userName)).data
      break
    case 'hashtag':
      posts.value = (await postsPlugin.getHashtagPosts(props.hashtagName)).data
      break
  }
}

const updateSubscruptions = async () => {
  const res = await postsPlugin.getSubscribtions()
  subscribtions.value = res.data
}

onMounted(() => {
  updatePosts()
  updateSubscruptions()
})
onUpdated(() => {
  console.log('updated');

  updatePosts()
  updateSubscruptions()
})
</script>

<template>
  <Layout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ props.userName || props.hashtagName || route.name }}
      </h2>
    </template>

    <PostForm @upload="updatePosts" v-if="$auth.user()" />

    <div class="flex flex-col lg:flex-row-reverse items-center lg:items-start gap-8 justify-center px-4">
      <SubscriptionsSideBar :subscribtions v-if="subscribtions.length > 0" />
      <div class="max-w-lg w-full lg:mx-0 mx-auto">
        <!-- Posts list -->
        <section class="space-y-9">
          <Post v-for="post in posts" :post @subscribed="() => updatePosts() && updateSubscruptions()" />
        </section>
      </div>
    </div>

  </Layout>
</template>