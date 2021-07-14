<template>
  <base-button
    type="button"
    icon="lock-closed"
    variant="warning"
    :loading="form.processing"
    :hide-label="hideLabel"
    @click="submit"
  >
    {{ $t('Impersonate') }}
  </base-button>
</template>

<script lang="ts">
  import { Model } from '@admin/types'
  import { useForm } from '@inertiajs/inertia-vue3'
  import { defineComponent, inject } from 'vue'
  import route from 'ziggy-js'

  export default defineComponent({
    props: {
      hideLabel: Boolean,
    },
    setup() {
      const resource = inject<string>('resource')
      const item = inject<Model>('item')

      const form = useForm({})

      const submit = () => {
        form.post(route(`admin.${resource}.impersonate`, item?.id), {
          preserveScroll: true,
        })
      }

      return {
        resource,
        item,
        submit,
        form,
      }
    },
  })
</script>
