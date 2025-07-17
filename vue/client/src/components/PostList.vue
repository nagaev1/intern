<script setup>
import Post from './Post.vue';
import PrimaryButton from './PrimaryButton.vue';
import { useRoute } from 'vue-router';
import { onMounted, watch, ref } from 'vue';

const { getPosts } = defineProps({
    getPosts: Function
})

const route = useRoute()
const postData = ref({})

const updatePosts = async (page) => {
    postData.value = (await getPosts(page || route.query.page)).data
}

onMounted(updatePosts)
watch(() => route.query.page, updatePosts)
defineExpose({ updatePosts })
const emit = defineEmits(['subscribed'])
</script>
<template>
    <section class="space-y-9" v-if="postData.data.length > 0">
        <Post v-for="post in postData.data" :post @subscribed="updatePosts" />
        <div class="flex justify-center gap-2 items-center">
            <router-link :to="{ name: $route.name, query: { page: 1 } }" v-if="Number($route.query.page || 1) > 2">
                <PrimaryButton>First</PrimaryButton>
            </router-link>
            <router-link :to="{ name: $route.name, query: { page: $route.query.page - 1 } }"
                v-if="Number($route.query.page || 1) > 1">
                <PrimaryButton>Prev</PrimaryButton>
            </router-link>
            <span>{{ postData.from }} - {{ postData.to }} ({{ postData.total }})</span>
            <router-link :to="{ name: $route.name, query: { page: 1 + Number($route.query.page || 1) } }"
                v-if="Number($route.query.page || 1) < postData.last_page">
                <PrimaryButton>next</PrimaryButton>
            </router-link>
            <router-link :to="{ name: $route.name, query: { page: postData.last_page } }"
                v-if="postData.last_page - Number($route.query.page || 1) > 1">
                <PrimaryButton>Last</PrimaryButton>
            </router-link>
        </div>
    </section>
</template>