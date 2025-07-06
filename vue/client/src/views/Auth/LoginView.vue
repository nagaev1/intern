<script setup>
import Checkbox from '@/components/Checkbox.vue'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/components/InputError.vue'
import InputLabel from '@/components/InputLabel.vue'
import PrimaryButton from '@/components/PrimaryButton.vue'
import TextInput from '@/components/TextInput.vue'
import { ref, inject } from 'vue'
import * as yup from 'yup'
import { useForm } from 'vee-validate'
import { useRouter } from 'vue-router'

const auth = inject('auth')
const router = useRouter()
const message = ref('')

const schema = yup.object({
  email: yup.string().email().required(),
  password: yup.string().required(),
})

const { defineField, handleSubmit, errors } = useForm({
  validationSchema: schema,
})

const [email, emailAttrs] = defineField('email')
const [password, passwordAttrs] = defineField('password')

const onSubmit = handleSubmit(async (values, { setErrors }) => {
  try {
    const res = await auth.login(values)
    console.log(res)
    router.push({ name: 'posts' })
  } catch (error) {
    console.error(error)
    if (error.response.data.errors) {
      setErrors(error.response.data.errors)
    } else if (error.response.data.message) {
      message.value = error.response.data.message
    }
  }
})
</script>

<template>
  <GuestLayout>
    <form @submit.prevent="onSubmit">
      <div>
        <InputLabel for="email" value="Email" />

        <TextInput
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="email"
          v-bind="emailAttrs"
          required
          autofocus
          autocomplete="username"
        />

        <InputError class="mt-2" :message="errors.email" />
      </div>

      <div class="mt-4">
        <InputLabel for="password" value="Password" />

        <TextInput
          id="password"
          type="password"
          class="mt-1 block w-full"
          v-model="password"
          v-bind="passwordAttrs"
          required
          autocomplete="current-password"
        />

        <InputError class="mt-2" :message="errors.password" />
      </div>
      <div class="text-sm text-red-600 mt-4">{{ message }}</div>

      <div class="mt-4 text-center">
        <router-link class="text-sm underline" :to="{ name: 'register' }">Register?</router-link>
      </div>

      <div class="mt-4 flex items-center justify-end">
        <router-link
          :to="{name: 'register'}"
          class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
          Forgot your password?
        </router-link>

        <PrimaryButton class="ms-4"> Log in </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
