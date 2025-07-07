<script setup>
import { ref, inject, watch, watchEffect } from 'vue'
import SecondaryButton from './SecondaryButton.vue'

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
  <SecondaryButton @click="subscribe" class="hover:bg-red-500 hover:text-white transition-colors">
    {{ isSubscribed ? 'Unsubscribe' : 'Subscribe' }}
  </SecondaryButton>
</template>
