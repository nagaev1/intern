<script setup>
import { ref, inject, watch, watchEffect } from 'vue'

const postsPlugin = inject('postsPlugin')

const emit = defineEmits(['subscribed'])

const props = defineProps({
  isSubscribed: {
    type: Boolean,
    required: true,
  },
  userId: {
    type: Number,
    required: true,
  },
})

const isSubscribed = ref(props.isSubscribed)

watchEffect(() => {
  isSubscribed.value = props.isSubscribed
})

const subscribe = async () => {
  postsPlugin.subscribe(props.userId)
  isSubscribed.value = !isSubscribed.value
  emit('subscribed')
}
</script>

<template>
  <button
    @click="subscribe"
    class="bg-red-400 hover:bg-red-500 px-4 py-2 rounded-xl transition-colors"
  >
    {{ isSubscribed ? 'Unsubscribe' : 'Subscribe' }}
  </button>
</template>
