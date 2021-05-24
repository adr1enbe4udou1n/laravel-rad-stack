<template>
  <action-section>
    <template #title> {{ $t('Delete Account') }} </template>

    <template #description>
      {{ $t('Permanently delete your account.') }}
    </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        {{
          $t(
            'Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'
          )
        }}
      </div>

      <div class="mt-5">
        <base-button
          variant="danger"
          icon="trash"
          type="button"
          @click="confirmUserDeletion"
        >
          {{ $t('Delete Account') }}
        </base-button>
      </div>

      <!-- Delete Account Confirmation Modal -->
      <dialog-modal
        :show="confirmingUserDeletion"
        @close="closeModal"
        @submit="submit"
      >
        <template #title> {{ $t('Delete Account') }} </template>

        <template #content>
          {{
            $t(
              'Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.'
            )
          }}

          <div class="mt-4 w-3/4">
            <base-input
              ref="password"
              v-model="form.password"
              :error="form.errors.password"
              type="password"
              :placeholder="$t('Password')"
            />
          </div>
        </template>

        <template #footer>
          <base-button outlined type="button" @click="closeModal">
            {{ $t('Cancel') }}
          </base-button>

          <base-button
            variant="danger"
            type="submit"
            class="ml-2"
            :loading="form.processing"
          >
            {{ $t('Delete Account') }}
          </base-button>
        </template>
      </dialog-modal>
    </template>
  </action-section>
</template>

<script lang="ts">
  import route from 'ziggy-js'
  import { useForm } from '@inertiajs/inertia-vue3'
  import { defineComponent, ref } from 'vue'

  export default defineComponent({
    setup() {
      const password = ref(null)
      const confirmingUserDeletion = ref(false)

      const form = useForm({
        password: '',
      })

      const confirmUserDeletion = () => {
        confirmingUserDeletion.value = true

        setTimeout(() => password.value?.focus(), 250)
      }

      const closeModal = () => {
        confirmingUserDeletion.value = false

        form.reset()
      }

      const submit = () => {
        form.delete(route('admin.current-user.destroy'), {
          preserveScroll: true,
          onSuccess: () => closeModal(),
          onError: () => password.value.focus(),
          onFinish: () => form.reset(),
        })
      }

      return {
        form,
        submit,
        password,
        confirmUserDeletion,
        confirmingUserDeletion,
        closeModal,
      }
    },
  })
</script>
