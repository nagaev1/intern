<script setup>
import GuestLayout from '/src/Layouts/GuestLayout.vue'
import InputLabel from '/src/components/InputLabel.vue'
import PrimaryButton from '/src/components/PrimaryButton.vue'
import TextInput from '/src/components/TextInput.vue'
import InputError from '@/components/InputError.vue'
import { inject, ref } from 'vue'
import * as yup from 'yup'
import { useForm } from 'vee-validate'
import { useRouter } from 'vue-router'

const router = useRouter()
const auth = inject('auth')
const message = ref('')

const schema = yup.object({
  name: yup.string().required(),
  email: yup.string().email().required(),
  password: yup.string().required(),
  password_confirmation: yup
    .string()
    .required()
    .oneOf([yup.ref('password'), null], 'Password must match'),
})

const { defineField, handleSubmit, errors } = useForm({
  validationSchema: schema,
})

const [name, nameAttrs] = defineField('name')
const [email, emailAttrs] = defineField('email')
const [password, passwordAttrs] = defineField('password')
const [passwordConfirmation, passwordConfirmationAttrs] = defineField('password_confirmation')

const onSubmit = handleSubmit(async (values, { setErrors }) => {
  try {
    await auth.register(values)
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
        <InputLabel for="name" value="Name" />
        <TextInput
          id="name"
          type="text"
          class="mt-1 block w-full"
          v-model="name"
          v-bind="nameAttrs"
          autofocus
          autocomplete="name"
        />

        <InputError :message="errors.name" />
      </div>

      <div class="mt-4">
        <InputLabel for="email" value="Email" />

        <TextInput
          id="email"
          type="email"
          name="email"
          class="mt-1 block w-full"
          v-model="email"
          v-bind="emailAttrs"
          autocomplete="username"
        />

        <InputError :message="errors.email" />
      </div>

      <div class="mt-4">
        <InputLabel for="password" value="Password" />

        <TextInput
          id="password"
          type="password"
          class="mt-1 block w-full"
          name="password"
          v-model="password"
          v-bind="passwordAttrs"
          autocomplete="new-password"
        />

        <InputError :message="errors.password" />
      </div>

      <div class="mt-4">
        <InputLabel for="password_confirmation" value="Confirm Password" />

        <TextInput
          id="password_confirmation"
          type="password"
          class="mt-1 block w-full"
          name="password_confirmation"
          v-model="passwordConfirmation"
          v-bind="passwordConfirmationAttrs"
          autocomplete="new-password"
        />

        <InputError :message="errors.passwordConfirmation" />
      </div>
      <div class="text-sm text-red-600 mt-4">{{ message }}</div>

      <div class="mt-4 flex items-center justify-end">
        <router-link
          :to="{ name: 'login' }"
          class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
          Already registered?
        </router-link>

        <PrimaryButton class="ms-4"> Register </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
