<script setup>
import PostLayout from '@/Layouts/PostLayout.vue';
import PostList from '@/components/PostList.vue';
import { useTemplateRef } from 'vue';

const postList = useTemplateRef('postList')
</script>

<template>
  <PostLayout header="posts" @uploaded="() => postList.updatePosts()">
    <PostList ref="postList" :getPosts="$postPlugin.getAllPosts" />
  </PostLayout>
</template>