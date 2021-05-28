<template>
  <base-button
    variant="info"
    icon="view-list"
    :href="route(`admin.${resource}`)"
    :hide-label="hideLabel"
    @click.stop
  >
    {{
      $t('admin.titles.index', {
        args: { resource: $tc(`crud.${resource}.name`, 10) },
      })
    }}
  </base-button>
</template>

<script lang="ts">
  import { defineComponent, inject } from 'vue'

  export default defineComponent({
    props: {
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
