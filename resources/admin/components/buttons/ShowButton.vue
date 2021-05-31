<template>
  <base-button
    icon="eye"
    :href="route(`admin.${resource}.show`, item?.id)"
    variant="success"
    :hide-label="hideLabel"
    :only="only"
    @click.stop
  >
    {{ $t('Show') }}
  </base-button>
</template>

<script lang="ts">
  import { Model } from '@admin/types'
  import { defineComponent, inject } from 'vue'

  export default defineComponent({
    props: {
      only: Array,
      hideLabel: Boolean,
    },
    setup() {
      const resource = inject<string>('resource')
      const item = inject<Model>('item')

      return {
        resource,
        item,
      }
    },
  })
</script>
