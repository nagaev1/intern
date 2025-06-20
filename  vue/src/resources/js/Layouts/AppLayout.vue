<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import NavLink from '@/Components/NavLink.vue';
</script>

<template>
    <div class="flex min-h-svh flex-col bg-gray-100 justify-between">
        <nav class=" bg-gray-200">
            <div class=" container mx-auto py-4 flex gap-4">
                <div class=" me-auto">
                    <NavLink href="/" class=" text-4xl">
                        Bitter
                    </NavLink>
                </div>
                <div class="">
                    <NavLink href="/" class=" text-2xl">
                        Лента
                    </NavLink>
                </div>
                <div class="ms-auto">
                    <NavLink :href="route('profile')" class="text-2xl" v-if="$page.props.auth.user">
                        Профиль
                    </NavLink>
                    <NavLink :href="route('login')" class="text-2xl" v-else>
                        Войти
                    </NavLink>
                </div>
            </div>
        </nav>
        <slot />
        <footer></footer>
    </div>
</template>
