<template>
  <select-input v-model="value" v-bind="props" :choices="choices" />
</template>

<script lang="ts">
  import { inputProps, inputSetup } from '@admin/mixins/input'
  import { referenceSetup } from '@admin/mixins/reference'
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      ...inputProps,
      modelValue: [String, Number, Array],
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
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
      const initial = inputSetup(props)

      const reference = referenceSetup(props, { emit })

      return { ...initial, ...reference, props }
    },
  })
</script>
