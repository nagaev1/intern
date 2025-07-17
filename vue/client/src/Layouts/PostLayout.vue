<script setup>
import Layout from '@/Layouts/Layout.vue';
import PostForm from '@/components/PostForm.vue';
import SubscriptionsSideBar from '@/components/SubscriptionsSideBar.vue';
import { onMounted, onUpdated } from 'vue';
import { useStore } from 'vuex';

const store = useStore()
const emit = defineEmits(['uploaded'])

const props = defineProps({
  header: {
    type: String,
    required: false
  }
})

const updateSubscriptions = () => {
  store.dispatch('UPDATE_SUBSCRIPTIONS')
}

onMounted(() => {
  updateSubscriptions()
})
</script>

<template>
  <Layout>
    <template #header v-if="props.header">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ props.header }}
      </h2>
    </template>

    <PostForm @upload="emit('uploaded')" v-if="$auth.user()" />

    <div class="flex flex-col lg:flex-row-reverse items-center lg:items-start gap-8 justify-center px-4 my-8">
      <SubscriptionsSideBar />
      <div class="max-w-lg w-full lg:mx-0 mx-auto">
        <slot />
      </div>
    </div>

  </Layout>
</template>