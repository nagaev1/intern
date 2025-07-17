<script setup>
import PostLayout from '@/Layouts/PostLayout.vue';
import PostList from '@/components/PostList.vue';
import { useTemplateRef } from 'vue';

const { hashtagName } = defineProps({
  hashtagName: String
})

const postList = useTemplateRef('postList')
</script>

<template>
  <PostLayout :header="`#${hashtagName}`" @uploaded="() => postList.updatePosts()">
    <PostList ref="postList" :getPosts="(page) => $postPlugin.getHashtagPosts(hashtagName, page)" />
  </PostLayout>
</template>