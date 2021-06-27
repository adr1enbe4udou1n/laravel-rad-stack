<template>
  <flatpickr-input-wrapper
    :options="config"
    :model-value="modelValue ? modelValue.split(',') : ''"
  />
</template>

<script lang="ts">
  import { computed, defineComponent } from 'vue'
  import { format } from 'date-fns'
  import { Options } from 'flatpickr/dist/types/options'

  export default defineComponent({
    props: {
      modelValue: String,
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
      const config = computed((): Options => {
        return {
          dateFormat: 'Y-m-d',
          mode: 'range',
          onChange: (dates: Date[]) => {
            emit(
              'update:modelValue',
              dates.length === 2
                ? dates.map((d) => format(d, 'yyyy-MM-dd')).join(',')
                : null
            )
          },
        }
      })

      return { config }
    },
  })
</script>
