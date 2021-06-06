<template>
  <auth-layout>
    <validation-errors class="mb-4" />

    <form @submit.prevent="submit">
      <div>
        <text-input
          v-model="form.email"
          :label="$t('Email')"
          type="email"
          required
        />
      </div>

      <div class="mt-4">
        <text-input
          v-model="form.password"
          :label="$t('Password')"
          type="password"
          required
          autocomplete="new-password"
          autofocus
        />
      </div>

      <div class="mt-4">
        <text-input
          v-model="form.password_confirmation"
          :label="$t('Confirm Password')"
          type="password"
          required
          autocomplete="new-password"
        />
      </div>

      <div class="mt-4">
        <base-button type="submit" class="w-full" :loading="form.processing">
          {{ $t('Reset Password') }}
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
    props: {
      token: String,
      email: String,
    },
    setup(props) {
      useTitle('Reset Password')

      const form = useForm({
        token: props.token,
        email: props.email,
        password: '',
        password_confirmation: '',
      })

      const submit = () => {
        form.post(route('password.update'), {
          onFinish: () => form.reset('password', 'password_confirmation'),
        })
      }

      return { form, submit }
    },
  })
</script>
