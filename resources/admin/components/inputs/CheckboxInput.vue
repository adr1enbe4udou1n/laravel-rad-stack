<template>
  <label class="flex items-center">
    <input
      type="checkbox"
      :checked="modelValue"
      class="
        rounded
        border-gray-300
        text-primary-600
        shadow-sm
        checked:bg-primary-500
        focus:border-primary-300
        focus:ring focus:ring-primary-200 focus:ring-opacity-50
      "
      @change="change"
    />
    <span class="ml-2 text-sm text-gray-600">{{ getLabel }}</span>
  </label>
</template>

<script lang="ts">
  import { inputProps, inputSetup } from '@admin/mixins/input'
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      ...inputProps,
      modelValue: Boolean,
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
      const initial = inputSetup(props)

      const change = (e: Event) => {
        emit('update:modelValue', (e.target as HTMLInputElement).checked)
      }

      return { ...initial, change }
    },
  })
</script>
