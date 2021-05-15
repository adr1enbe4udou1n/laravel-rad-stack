<template>
  <div>
    <teleport to="head">
      <title>{{ $title('Login') }}</title>
    </teleport>
    <auth-card>
      <validation-errors class="mb-4" />

      <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
      </div>

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

          <base-button
            class="ml-4"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            {{ $t('Log in') }}
          </base-button>
        </div>
      </form>
    </auth-card>
  </div>
</template>

<script lang="ts">
  import { useRoute } from '@admin/plugins/route'
  import { useForm } from '@inertiajs/inertia-vue3'
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      canResetPassword: Boolean,
      status: String,
    },
    setup() {
      const form = useForm({
        email: null,
        password: null,
        remember: false,
      })

      const submit = () => {
        form
          .transform((data) => ({
            ...data,
            remember: data.remember ? 'on' : '',
          }))
          .post(useRoute('login'))
      }

      return { form, submit }
    },
  })
</script>
