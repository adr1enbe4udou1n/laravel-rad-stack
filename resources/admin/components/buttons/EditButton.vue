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
      return {
        resource: inject<string>('resource'),
        item: inject<Model>('item'),
      }
    },
  })
</script>
