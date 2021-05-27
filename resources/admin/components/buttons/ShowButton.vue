<template>
  <base-button
    icon="eye"
    :href="route(`admin.${resource}.show`, item.id)"
    variant="success"
    @click.stop
  />
</template>

<script lang="ts">
  import { Model } from '@admin/types'
  import { defineComponent, inject } from 'vue'

  export default defineComponent({
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
