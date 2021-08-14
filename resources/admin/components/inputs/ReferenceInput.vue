<template>
  <select-input v-model="modelValue" v-bind="props" :choices="choices" />
</template>

<script lang="ts" setup>
  import { inputProps, inputSetup } from '@admin/mixins/input'
  import { referenceSetup } from '@admin/mixins/reference'
  import {} from 'vue'

  const props = defineProps({
    ...inputProps,
    multiple: Boolean,
    resource: {
      type: String,
      required: true,
    },
    optionText: {
      type: String,
      default: 'name',
    },
    optionValue: {
      type: String,
      default: 'id',
    },
    allowEmpty: Boolean,
    emptyText: String,
  })

  const { modelValue } = inputSetup(props)

  const emit = defineEmits(['update:modelValue'])
  const { choices } = referenceSetup(props, emit)
</script>
