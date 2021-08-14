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

<script lang="ts" setup>
  import { computed, PropType } from 'vue'
  import { inputProps, inputSetup } from '@admin/mixins/input'
  import { Options } from 'flatpickr/dist/types/options'

  const props = defineProps({
    ...inputProps,
    options: Object as PropType<Options>,
  })

  const { getLabel, modelValue, getError, hasError, id } = inputSetup(props)

  const config = computed((): Options => {
    const config: Options = props.options || {
      enableTime: true,
      dateFormat: 'Y-m-d H:i',
    }
    if (!config.onChange) {
      config.onChange = (dates: Date[]) => {
        modelValue.value = dates[0]
      }
    }
    return config
  })
</script>
