<script setup>
import { ref } from 'vue'
import Dropdown from '/src/components/Dropdown.vue'
import DropdownLink from '/src/components/DropdownLink.vue'
import PostForm from '@/components/PostForm.vue'
import NavLink from '/src/components/NavLink.vue'
import ResponsiveNavLink from '/src/components/ResponsiveNavLink.vue'
const showingNavigationDropdown = ref(false)
</script>

<template>
  <div>
    <div class="min-h-screen bg-gray-100">
      <nav class="border-b border-gray-100 bg-white">
        <!-- Primary Navigation Menu -->
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <div class="flex h-16 justify-between">
            <div class="flex">
              <!-- Logo -->
              <div class="flex shrink-0 items-center">
                <router-link :to="{ name: 'posts' }" class="text-4xl"> Bitter </router-link>
              </div>

              <!-- Navigation Links -->
              <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <NavLink :to="{ name: 'posts' }" :active="$route.name == 'posts'"> Posts </NavLink>
                <NavLink :to="{ name: 'feed' }" :active="$route.name == 'feed'"> Feed </NavLink>
              </div>
            </div>

            <div class="hidden sm:ms-6 sm:flex sm:items-center">
              <!-- Settings Dropdown -->
              <div class="relative ms-3" v-if="$auth.user()">
                <Dropdown align="right" width="48">
                  <template #trigger>
                    <span class="inline-flex rounded-md">
                      <button type="button"
                        class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none">
                        {{ $auth.user().name }}

                        <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                          fill="currentColor">
                          <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                        </svg>
                      </button>
                    </span>
                  </template>

                  <template #content>
                    <!-- <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink> -->
                    <router-link
                      class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
                      @click="$auth.logout()" :to="{ name: 'login' }">
                      Log out
                    </router-link>
                  </template>
                </Dropdown>
              </div>
              <div class="relative ms-3" v-else>
                <router-link :to="{ name: 'login' }"> Log in </router-link>
              </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
              <button @click="showingNavigationDropdown = !showingNavigationDropdown"
                class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                  <path :class="{
                    hidden: showingNavigationDropdown,
                    'inline-flex': !showingNavigationDropdown,
                  }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                  <path :class="{
                    hidden: !showingNavigationDropdown,
                    'inline-flex': showingNavigationDropdown,
                  }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{
          block: showingNavigationDropdown,
          hidden: !showingNavigationDropdown,
        }" class="sm:hidden">
          <div class="space-y-1 pb-3 pt-2">
            <ResponsiveNavLink :to="{ name: 'posts' }" :active="$route.name == 'posts'">
              Posts
            </ResponsiveNavLink>
            <!--             
            <ResponsiveNavLink :href="route('posts.feed')" :active="route().current('posts.feed')">
              feed 
            </ResponsiveNavLink> -->
          </div>

          <!-- Responsive Settings Options -->
          <div class="border-t border-gray-200 pb-1 pt-4">
            <div v-if="$auth.user()">
              <div class="px-4">
                <div class="text-base font-medium text-gray-800">
                  {{ $auth.user().name }}
                </div>
                <div class="text-sm font-medium text-gray-500">
                  {{ $auth.user().email }}
                </div>
              </div>

              <div class="mt-3 space-y-1">
                <!-- <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink> -->
                <ResponsiveNavLink @click="$auth.logout()" :to="{ name: 'login' }" as="button">
                  Log Out
                </ResponsiveNavLink>
              </div>
            </div>
            <div v-else>
              <ResponsiveNavLink :to="{ name: 'register' }"> Register </ResponsiveNavLink>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Heading -->
      <header class="bg-white shadow" v-if="$slots.header">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
          <slot name="header" />
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <slot />
      </main>
    </div>
  </div>
</template>
