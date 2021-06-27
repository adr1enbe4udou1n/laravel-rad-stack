<template>
  <base-button
    variant="success"
    icon="plus"
    :href="route(`admin.${resource}.create`)"
    :hide-label="hideLabel"
    :only="only"
  >
    {{
      $t('admin.titles.create', {
        args: { resource: $tc(`crud.${resource}.name`, 0) },
      })
    }}
  </base-button>
</template>

<script lang="ts">
  import { defineComponent, inject } from 'vue'

  export default defineComponent({
    props: {
      only: Array,
      hideLabel: Boolean,
    },
    setup() {
      const resource = inject<string>('resource')

      return {
        resource,
      }
    },
  })
</script>
