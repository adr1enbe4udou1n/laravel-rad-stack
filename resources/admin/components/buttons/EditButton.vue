<template>
  <base-button
    icon="pencil"
    :href="route(`admin.${resource}.edit`, item.id)"
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
