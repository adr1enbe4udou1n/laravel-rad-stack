<template>
  <auth-layout>
    <div class="mb-4 text-sm text-gray-600">
      {{
        $t(
          'This is a secure area of the application. Please confirm your password before continuing.'
        )
      }}
    </div>

    <validation-errors class="mb-4" />

    <form @submit.prevent="submit">
      <div>
        <base-input
          v-model="form.password"
          :label="$t('Password')"
          type="password"
          required
          autocomplete="current-password"
          autofocus
        />
      </div>

      <div class="mt-4">
        <base-button type="submit" class="w-full" :loading="form.processing">
          {{ $t('Confirm') }}
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
    setup() {
      useTitle('Confirm Password')

      const form = useForm({
        password: '',
      })

      const submit = () => {
        form.post(route('password.confirm'), {
          onFinish: () => form.reset(),
        })
      }

      return { form, submit }
    },
  })
</script>
