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
  <dialog-modal
    :form="form"
    :show="confirming"
    @close="closeModal"
    @submit="submit"
  >
    <template #title>
      {{ $t('admin.confirm.delete_many_title', { args }) }}
    </template>

    <template #content>
      {{ $t('admin.confirm.delete_many_message', { args }) }}
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
  import { useForm } from '@inertiajs/inertia-vue3'
  import { transChoice } from 'matice'
  import { computed, defineComponent, inject, ref } from 'vue'
  import route from 'ziggy-js'

  export default defineComponent({
    props: {
      hideLabel: Boolean,
      selected: Array,
    },
    setup(props) {
      const resource = inject<string>('resource')
      const confirming = ref(false)

      const form = useForm({
        ids: props.selected,
      })

      const confirm = () => {
        confirming.value = true
      }

      const closeModal = () => {
        confirming.value = false
      }

      const submit = () => {
        form.delete(route(`admin.${resource}.bulk.destroy`), {
          preserveState: false,
          onSuccess: () => closeModal(),
        })
      }

      const args = computed(() => {
        return {
          resource: transChoice(
            `crud.${resource}.name`,
            props.selected?.length || 0
          ).toLowerCase(),
          count: props.selected?.length,
        }
      })

      return {
        resource,
        confirming,
        form,
        confirm,
        closeModal,
        submit,
        args,
      }
    },
  })
</script>
