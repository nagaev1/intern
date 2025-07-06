<script setup>
const model = defineModel({
  required: true,
})
</script>

<template>
  <input
    class="rounded-md border-gray-300 p-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
    v-model="model"
  />
</template>
