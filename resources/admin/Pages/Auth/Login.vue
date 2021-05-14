<template>
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
        <base-label for="email" value="Email" />
        <base-input
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full"
          required
          autofocus
        />
      </div>

      <div class="mt-4">
        <base-label for="password" value="Password" />
        <base-input
          id="password"
          v-model="form.password"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="current-password"
        />
      </div>

      <div class="block mt-4">
        <label class="flex items-center">
          <base-checkbox v-model:checked="form.remember" name="remember" />
          <span class="ml-2 text-sm text-gray-600">Remember me</span>
        </label>
      </div>

      <div class="flex items-center justify-end mt-4">
        <inertia-link
          v-if="canResetPassword"
          :href="route('password.request')"
          class="underline text-sm text-gray-600 hover:text-gray-900"
        >
          Forgot your password?
        </inertia-link>

        <base-button
          class="ml-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Log in
        </base-button>
      </div>
    </form>
  </auth-card>
</template>

<script lang="ts">
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
          .post('/login')
      }

      return { form, submit }
    },
  })
</script>
