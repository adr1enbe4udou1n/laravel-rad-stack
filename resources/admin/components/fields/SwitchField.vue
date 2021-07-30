<template>
  <switch-toggle v-model="modelValue" @click.stop />
</template>

<script lang="ts">
  import { Model } from '@admin/types'
  import { Inertia } from '@inertiajs/inertia'
  import { computed, defineComponent, inject } from 'vue'
  import route from 'ziggy-js'

  export default defineComponent({
    props: {
      value: {
        type: Boolean,
        required: true,
      },
      field: {
        type: String,
        required: true,
      },
    },
    setup(props) {
      const resource = inject<string>('resource')
      const item = inject<Model>('item')

      const modelValue = computed({
        get: () => props.value,
        set: (val) => {
          Inertia.patch(route(`admin.${resource}.toggle`, { id: item!.id }), {
            [props.field]: val,
          })
        },
      })

      return { modelValue }
    },
  })
</script>
