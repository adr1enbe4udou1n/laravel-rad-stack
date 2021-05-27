<template>
  <base-button
    icon="lock-closed"
    variant="warning"
    :href="route(`admin.${resource}.impersonate`, item.id)"
    @click.stop
  ></base-button>
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
