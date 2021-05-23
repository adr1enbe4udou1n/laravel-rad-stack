<template>
  <form-section @submitted="submit">
    <template #title> {{ $t('Update Password') }} </template>

    <template #description>
      {{
        $t(
          'Ensure your account is using a long, random password to stay secure.'
        )
      }}
    </template>

    <template #form>
      <div class="col-span-6 sm:col-span-4">
        <base-input
          id="current_password"
          ref="current_password"
          v-model="form.current_password"
          :label="$t('Current Password')"
          type="password"
          required
          autocomplete="current-password"
          :error="form.errors.current_password"
        />
      </div>

      <div class="col-span-6 sm:col-span-4">
        <base-input
          id="password"
          ref="password"
          v-model="form.password"
          :label="$t('New Password')"
          type="password"
          required
          autocomplete="new-password"
          :error="form.errors.password"
        />
      </div>

      <div class="col-span-6 sm:col-span-4">
        <base-input
          id="password_confirmation"
          v-model="form.password_confirmation"
          :label="$t('Confirm Password')"
          type="password"
          required
          autocomplete="new-password"
          :error="form.errors.password_confirmation"
        />
      </div>
    </template>

    <template #actions>
      <action-message :on="form.recentlySuccessful" class="mr-3">
        {{ $t('Saved.') }}
      </action-message>

      <base-button type="submit" :loading="form.processing">
        {{ $t('Save') }}
      </base-button>
    </template>
  </form-section>
</template>

<script lang="ts">
  import { route } from '@admin/plugins/route'
  import { useForm } from '@inertiajs/inertia-vue3'
  import { defineComponent, ref } from 'vue'

  export default defineComponent({
    setup() {
      const password = ref(null)
      const current_password = ref(null)

      const form = useForm({
        current_password: '',
        password: '',
        password_confirmation: '',
      })

      const submit = () => {
        form.put(route('user-password.update'), {
          errorBag: 'updatePassword',
          preserveScroll: true,
          onSuccess: () => {
            form.reset()
          },
          onError: () => {
            if (form.errors.password) {
              form.reset('password', 'password_confirmation')
              password.value?.focus()
            }

            if (form.errors.current_password) {
              form.reset('current_password')
              current_password.value?.focus()
            }
          },
        })
      }

      return { form, submit, password, current_password }
    },
  })
</script>
