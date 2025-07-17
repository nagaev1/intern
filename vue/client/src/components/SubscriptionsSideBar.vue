<script setup>
import { computed } from 'vue';
import { useStore } from 'vuex';

const store = useStore()
const subscriptions = computed(() => store.state.subscriptions)
</script>

<template>
    <nav class="bg-white p-4 rounded-lg w-full max-w-sm space-y-2 shadow-lg" v-if="subscriptions.length > 0">
        <h1>Subscriptions</h1>
        <ul>
            <li v-for="subscription in subscriptions" class="hover:bg-black/10 p-2 rounded-lg">
                <router-link class="size-full block"
                    :to="{ name: 'userPosts', params: { userName: subscription.user.name } }">
                    {{ subscription.user.name }}
                </router-link>
            </li>
        </ul>
    </nav>
</template>