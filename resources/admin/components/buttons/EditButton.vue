<template>
  <base-button
    v-if="item"
    icon="pencil"
    variant="info"
    :href="route(`admin.${resource}.edit`, { id: item.id })"
    :hide-label="hideLabel"
    :only="only"
  >
    {{ $t('Edit') }}
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
