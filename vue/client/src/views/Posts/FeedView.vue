<script setup>
import PostLayout from '@/Layouts/PostLayout.vue';
import PostList from '@/components/PostList.vue';
import { useTemplateRef } from 'vue';

const postList = useTemplateRef('postList')
</script>

<template>
  <PostLayout header="feed" @uploaded="() => postList.updatePosts()">
    <PostList ref="postList" :getPosts="$postPlugin.getFeedPosts" />
  </PostLayout>
</template>