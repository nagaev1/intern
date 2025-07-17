<script setup>
import PostLayout from '@/Layouts/PostLayout.vue';
import PostList from '@/components/PostList.vue';
import { useTemplateRef } from 'vue';

const { userName } = defineProps({
  userName: String
})

const postList = useTemplateRef('postList')
</script>

<template>
  <PostLayout :header="`@${userName}`" @uploaded="() => postList.updatePosts()">
    <PostList ref="postList" :getPosts="(page) => $postPlugin.getUserPosts(userName, page)" />
  </PostLayout>
</template>