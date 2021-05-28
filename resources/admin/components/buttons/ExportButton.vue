<template>
  <base-button
    tag="a"
    icon="download"
    :href="route(`admin.${resource}`, getExportQuery)"
    :hide-label="hideLabel"
    @click.stop
  >
    {{ $t('admin.data-table.export') }}
  </base-button>
</template>

<script lang="ts">
  import { computed, defineComponent, inject } from 'vue'
  import { InputParams } from 'ziggy-js'

  export default defineComponent({
    props: {
      hideLabel: Boolean,
    },
    setup() {
      const resource = inject<string>('resource')

      const getExportQuery = computed((): InputParams => {
        return {
          export: true,
        }
      })

      return {
        resource,
        getExportQuery,
      }
    },
  })
</script>
