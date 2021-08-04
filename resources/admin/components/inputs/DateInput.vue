<template>
  <input-label :for="id" class="mb-1" :value="getLabel" />
  <flatpickr-input-wrapper
    v-bind="$attrs"
    :id="id"
    class="block w-full"
    :class="{ 'form-invalid': hasError }"
    :options="config"
    :model-value="modelValue"
  />
  <input-error :message="getError" class="mt-2" />
  <input-hint :message="hint" class="mt-2" />
</template>

<script lang="ts">
  import { computed, defineComponent, PropType } from 'vue'
  import { inputProps, inputSetup } from '@admin/mixins/input'
  import { Options } from 'flatpickr/dist/types/options'

  export default defineComponent({
    props: {
      ...inputProps,
      modelValue: [String, Number, Date],
      options: Object as PropType<Options>,
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
      const initial = inputSetup(props)

      const config = computed((): Options => {
        const config: Options = props.options || {
          enableTime: true,
          dateFormat: 'Y-m-d H:i',
        }
        if (!config.onChange) {
          config.onChange = (dates: Date[]) => {
            emit('update:modelValue', dates[0])
          }
        }
        return config
      })

      return { ...initial, config }
    },
  })
</script>
