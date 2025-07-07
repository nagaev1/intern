<script setup>
import InputError from './InputError.vue'
import * as yup from 'yup'
import { inject } from 'vue'
import { ref } from 'vue'
import { useForm } from 'vee-validate'
import PrimaryButton from './PrimaryButton.vue'

const postsPlugin = inject('postsPlugin')
const message = ref('')

const emit = defineEmits(['upload'])

const schema = yup.object({
  text: yup.string().required().max(255),
})

const { defineField, handleSubmit, errors, setErrors } = useForm({
  validationSchema: schema,
})

const onSubmit = handleSubmit(async (values, { setErrors }) => {
  try {
    const res = await postsPlugin.upload(values)
    console.log(res)
    emit('upload')
  } catch (error) {
    console.error(error)
    if (error.response && error.response.data.message) {
      message.value = error.response.data.message
    }
  }
})

const [text, textAttrs] = defineField('text')
</script>

<template>
  <div class="my-10 max-w-7xl px-4 mx-auto">
    <form @submit.prevent="onSubmit" class="space-y-4">
      <textarea v-model="text" v-bind="textAttrs" class="block rounded-lg max-w-lg w-full border-1 p-2"
        placeholder="Текст поста" />
      <InputError class="mt-2" :message="errors.text" />
      <PrimaryButton>
        Upload
      </PrimaryButton>
      <InputError class="mt-2" :message="message" />
    </form>
  </div>
</template>
