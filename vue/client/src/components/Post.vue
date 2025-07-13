<script setup>
import SubscribeButton from './SubscribeButton.vue'
import { ref, onMounted, onUpdated, watch } from 'vue'

const emit = defineEmits(['subscribed'])
const textMatches = ref([])
const { post } = defineProps({
  post: Object,
})

const regex = /(@[^@]+@)|(#[^#]+#)|([^@#]+)/g
onMounted(() => textMatches.value = post.text.matchAll(regex))
watch(() => post, (newPost) => {
  textMatches.value = newPost.text.matchAll(regex)
})
</script>

<template>
  <div class="space-y-4 w-full max-w-lg bg-white rounded-lg p-4 shadow-lg">
    <div class="flex justify-between">
      <router-link :to="{ name: 'userPosts', params: { userName: post.user.name } }" class="hover:underline">
        {{ post.user.name }}
      </router-link>
      <p class="text-end">
        <span class="text-xs text-gray-400">{{ post.created_at }}</span>
      </p>
    </div>
    <p>
      <template v-for="match of textMatches" is="template">
        <template v-if="match[3]">{{ match[3] }}</template>
        <router-link v-else class="underline text-blue-400 visited:text-blue-500" :to="{
          name: match[1] ? 'userPosts' : 'hashtag',
          params: { [match[1] ? 'userName' : 'hashtagName']: match[0].substring(1, match[0].length - 1) }
        }">
          {{ match[0].slice(0, -1) }}
        </router-link>
      </template>
    </p>
    <div class="text-end" v-if="$auth.user()">
      <SubscribeButton @subscribed="emit('subscribed')" :isSubscribed="post.user.is_subscribed"
        :userId="post.user.id" />
    </div>
  </div>
</template>