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
      filter: Object as PropType<{ [key: string]: string }>,
    },
    setup(props) {
      const resource = inject<string>('resource')

      const exportUrl = computed((): InputParams => {
        return `${route(`admin.${resource}`)}?${qs.stringify({
          filter: props.filter,
          export: true,
        })}`
      })

      return {
        resource,
        exportUrl,
      }
    },
  })
</script>
