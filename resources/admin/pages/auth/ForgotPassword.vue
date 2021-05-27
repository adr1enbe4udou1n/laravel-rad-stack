<template>
  <auth-layout>
    <div class="mb-4 text-sm text-gray-600">
      {{
        $t(
          'Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.'
        )
      }}
    </div>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <validation-errors class="mb-4" />

    <form @submit.prevent="submit">
      <div>
        <text-input
          v-model="form.email"
          :label="$t('Email')"
          type="email"
          required
          autofocus
        />
      </div>

      <div class="mt-4">
        <base-button
          type="submit"
          class="w-full text-center"
          :loading="form.processing"
        >
          {{ $t('Email Password Reset Link') }}
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
      status: String,
    },
    setup() {
      useTitle('Email Password Reset Link')

      const form = useForm({
        email: '',
      })

      const submit = () => {
        form.post(route('password.email'))
      }

      return { form, submit }
    },
  })
</script>
