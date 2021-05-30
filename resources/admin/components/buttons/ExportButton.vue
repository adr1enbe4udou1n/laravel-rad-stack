<template>
  <base-button
    tag="a"
    icon="download"
    :href="exportUrl"
    :hide-label="hideLabel"
    @click.stop
  >
    {{ $t('admin.data-table.export') }}
  </base-button>
</template>

<script lang="ts">
  import { computed, defineComponent, inject, PropType } from 'vue'
  import route, { InputParams } from 'ziggy-js'
  import qs from 'qs'

  export default defineComponent({
    props: {
      hideLabel: Boolean,
    },
    setup() {
      const resource = inject<string>('resource')
      const filter = inject<{ [key: string]: string }>('filter')

      const exportUrl = computed((): InputParams => {
        return `${route(`admin.${resource}`)}?${qs.stringify({
          filter,
          export: true,
        })}`
      })

      return {
        resource,
        filter,
        exportUrl,
      }
    },
  })
</script>
