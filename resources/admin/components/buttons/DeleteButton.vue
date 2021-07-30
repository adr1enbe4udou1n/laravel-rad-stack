<template>
  <base-button
    type="button"
    icon="trash"
    variant="danger"
    :hide-label="hideLabel"
    @click="confirm"
  >
    {{ $t('Delete') }}
  </base-button>

  <!-- Delete Account Confirmation Modal -->
  <dialog-modal :show="confirming" @close="closeModal" @submit="submit">
    <template #title>
      {{ $t('admin.confirm.delete_title', { args }) }}
    </template>

    <template #content>
      {{ $t('admin.confirm.delete_message', { args }) }}
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
        {{ $t('Delete') }}
      </base-button>
    </template>
  </dialog-modal>
</template>

<script lang="ts">
  import { useModelToString } from '@admin/features/helpers'
  import { Model } from '@admin/types'
  import { useForm } from '@inertiajs/inertia-vue3'
  import { transChoice } from 'matice'
  import { defineComponent, inject, ref } from 'vue'
  import route from 'ziggy-js'

  export default defineComponent({
    props: {
      hideLabel: Boolean,
    },
    setup() {
      const resource = inject<string>('resource')
      const item = inject<Model>('item')
      const confirming = ref(false)

      const form = useForm({})

      const confirm = () => {
        confirming.value = true
      }

      const closeModal = () => {
        confirming.value = false
      }

      const submit = () => {
        form.delete(route(`admin.${resource}.destroy`, { id: item!.id }), {
          preserveScroll: true,
          onSuccess: () => closeModal(),
        })
      }

      return {
        resource,
        item,
        confirming,
        form,
        confirm,
        closeModal,
        submit,
        args: {
          resource: transChoice(`crud.${resource}.name`, 0).toLowerCase(),
          label: useModelToString(resource, item),
        },
      }
    },
  })
</script>
