<script setup>
import { ref } from 'vue';

const props = defineProps({
    onChange: Function,
    checked: Boolean,
    id: String
})

const checked = ref(props.checked)

</script>

<template>
    <input type="checkbox" :id="props.id" class="hidden" @change="props.onChange"
        v-model="checked">
    <label :for="props.id"
        class="bg-red-400 hover:bg-red-500 px-4 py-2 rounded-xl transition-colors">{{ checked ? 'Unsubscribe' : 'Subscribe' }}</label>
</template>