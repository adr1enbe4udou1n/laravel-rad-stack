<template>
  <auth-layout>
    <validation-errors class="mb-4" />

    <form @submit.prevent="submit">
      <div>
        <base-input
          v-model="form.name"
          :label="$t('Name')"
          type="text"
          required
          autofocus
          autocomplete="name"
        />
      </div>

      <div class="mt-4">
        <base-input
          v-model="form.email"
          :label="$t('Email')"
          type="email"
          required
        />
      </div>

      <div class="mt-4">
        <base-input
          v-model="form.password"
          :label="$t('Password')"
          type="password"
          required
          autocomplete="new-password"
        />
      </div>

      <div class="mt-4">
        <base-input
          v-model="form.password_confirmation"
          :label="$t('Confirm Password')"
          type="password"
          required
          autocomplete="new-password"
        />
      </div>

      <div class="flex items-center justify-end mt-4">
        <inertia-link
          :href="route('login')"
          class="underline text-sm text-gray-600 hover:text-gray-900"
        >
          {{ $t('Already registered?') }}
        </inertia-link>

        <base-button type="submit" class="ml-4" :loading="form.processing">
          {{ $t('Register') }}
        </base-button>
      </div>
    </form>
  </auth-layout>
</template>

<script lang="ts">
  import { useTitle } from '@admin/features/helpers'
  import route from 'ziggy-js'
  import { useForm } from '@inertiajs/inertia-vue3'
  import { defineComponent } from 'vue'

  export default defineComponent({
    setup() {
      useTitle('Register')

      const form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      })

      const submit = () => {
        form.post(route('register'), {
          onFinish: () => form.reset('password', 'password_confirmation'),
        })
      }

      return { form, submit }
    },
  })
</script>
