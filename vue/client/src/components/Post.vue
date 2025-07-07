<script setup>
import SubscribeButton from './SubscribeButton.vue'

const emit = defineEmits(['subscribed'])

const { post } = defineProps({
  post: Object,
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
      {{ post.text }}
    </p>
    <div class="text-end" v-if="$auth.user()">
      <SubscribeButton @subscribed="emit('subscribed')" :isSubscribed="post.user.is_subscribed"
        :userId="post.user.id" />
    </div>
  </div>
</template>
