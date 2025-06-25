<script setup>
import Layout from '@/Layouts/Layout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import axios from 'axios';
import SubscribeButton from '@/Components/SubscribeButton.vue';

const props = defineProps({
    posts: Array
})

const postForm = useForm({
    text: ''
})

const subscribeForm = useForm({
    userId: '',
})

const submit = () => {
    postForm.post(route('posts.store'), {
        onFinish: () => postForm.reset(),
    });
};

const subscribe = async (e, userId) => {
    console.log(userId);

    axios.post(route('users.subscribe', userId), {}, {
        method: 'POST'
    })
}

</script>
<template>
    <Layout>

        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Posts
            </h2>
        </template>

        <!-- Post form -->
        <section class="my-10 container mx-auto">
            <form @submit.prevent="submit" class=" space-y-4" v-if="$page.props.auth.user">
                <textarea name="text" v-model="postForm.text" required placeholder="Текст поста"
                    class="block rounded-lg max-w-lg w-full">
        </textarea>
                <div v-if="postForm.errors.text" class="text-red-600">{{ postForm.errors.text }}</div>
                <button
                    class=" bg-blue-400 hover:bg-blue-500 transition-colors px-4 py-2 rounded-xl text-xl">Upload</button>
            </form>
        </section>

        <!-- Posts list -->
        <section class="container mx-auto space-y-9">
            <div class=" space-y-4 max-w-lg mx-auto bg-white rounded-lg p-4 shadow-lg" v-for="(post, i) in props.posts">
                <div class="">
                    <Link :href="route('posts.user', post.user.name)" class="hover:underline">
                        {{ post.user.name }}
                    </Link>
                </div>
                <p>
                    {{ post.text }}
                </p>
                <div class="text-end" v-if="$page.props.auth.user">
                    <SubscribeButton :onChange="(e) => subscribe(e, post.user.id)" :id="`subscribe-${i}`" :checked="post.user.is_subscribed" />
                    </div>
                <p class="text-end">
                    <span class="text-xs text-gray-400">{{ post.created_at }}</span>
                </p>
            </div>
        </section>

    </Layout>
</template>