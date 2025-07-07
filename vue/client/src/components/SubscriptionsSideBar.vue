<script setup>
const props = defineProps({
    subscribtions: {
        type: Array,
        required: true
    }
})

</script>

<template>
    <nav class="bg-white p-4 rounded-lg w-full max-w-sm space-y-2 shadow-lg">
        <h1>Subscriptions</h1>
        <ul>
            <li v-for="subscribtion in subscribtions" class="hover:bg-black/10 p-2 rounded-lg">
                <router-link :to="{ name: 'userPosts', params: { userName: subscribtion.user.name } }">
                    {{ subscribtion.user.name }}
                </router-link>
            </li>
        </ul>
    </nav>
</template>