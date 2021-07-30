<template>
  <base-button
    v-if="item"
    icon="eye"
    :href="route(`admin.${resource}.show`, { id: item.id })"
    variant="success"
    :hide-label="hideLabel"
    :only="only"
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
