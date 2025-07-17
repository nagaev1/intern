<script setup>
import { ref, inject, watchEffect } from 'vue'
import SecondaryButton from './SecondaryButton.vue'
import { useStore } from 'vuex'

const store = useStore()
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
  isSubscribed.value = !isSubscribed.value
  await postsPlugin.subscribe(props.userId)
  store.dispatch('UPDATE_SUBSCRIPTIONS')
  emit('subscribed')
}
</script>

<template>
  <SecondaryButton @click="subscribe" class="hover:bg-red-500 hover:text-white transition-colors">
    {{ isSubscribed ? 'Unsubscribe' : 'Subscribe' }}
  </SecondaryButton>
</template>
