<template>
  <auth-layout>
    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <validation-errors class="mb-4" />

    <form @submit.prevent="submit">
      <div>
        <base-input
          v-model="form.email"
          :label="$t('Email')"
          type="email"
          required
          autofocus
        />
      </div>

      <div class="mt-4">
        <base-input
          v-model="form.password"
          :label="$t('Password')"
          type="password"
          required
          autocomplete="current-password"
        />
      </div>

      <div class="mt-4">
        <base-checkbox
          v-model:checked="form.remember"
          name="remember"
          :label="$t('Remember me')"
        />
      </div>

      <div class="flex items-center justify-end mt-4">
        <inertia-link
          v-if="canResetPassword"
          :href="route('password.request')"
          class="underline text-sm text-gray-600 hover:text-gray-900"
        >
          {{ $t('Forgot your password?') }}
        </inertia-link>

        <base-button type="submit" class="ml-4" :loading="form.processing">
          {{ $t('Log in') }}
        </base-button>
      </div>
    </form>
  </auth-layout>
</template>

<script lang="ts">
  import { useTitle } from '@admin/features/helpers'
  import { route } from '@admin/plugins/route'
  import { useForm } from '@inertiajs/inertia-vue3'
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      canResetPassword: Boolean,
      status: String,
    },
    setup() {
      useTitle('Login')

      const form = useForm({
        email: '',
        password: '',
        remember: false,
      })

      const submit = () => {
        form
          .transform((data) => ({
            ...data,
            remember: data.remember ? 'on' : '',
          }))
          .post(route('login'))
      }

      return { form, submit }
    },
  })
</script>
