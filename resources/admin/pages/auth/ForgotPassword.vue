<template>
  <div>
    <teleport to="head">
      <title>{{ $title('Login') }}</title>
    </teleport>
    <auth-card>
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
          <base-input
            v-model="form.email"
            :label="$t('Email')"
            type="email"
            required
            autofocus
          />
        </div>

        <div class="flex items-center justify-end mt-4">
          <base-button class="ml-4" :loading="form.processing">
            {{ $t('Email Password Reset Link') }}
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
      status: String,
    },
    setup() {
      const form = useForm({
        email: '',
      })

      const submit = () => {
        form.post(useRoute('password.email'))
      }

      return { form, submit }
    },
  })
</script>
