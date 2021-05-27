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
      return {
        resource: inject<string>('resource'),
        item: inject<Model>('item'),
      }
    },
  })
</script>
