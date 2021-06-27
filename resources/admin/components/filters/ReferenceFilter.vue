<template>
  <select-filter
    v-model="value"
    :choices="choices"
    :option-text="optionText"
    :option-value="optionValue"
  />
</template>

<script lang="ts">
  import { referenceSetup } from '@admin/mixins/reference'
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      modelValue: String,
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
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
      const reference = referenceSetup(props, { emit })

      return { ...reference }
    },
  })
</script>
