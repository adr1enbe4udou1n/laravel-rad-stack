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
        focus:border-primary-300
        focus:ring focus:ring-primary-200 focus:ring-opacity-50
      "
      @change="change"
    />
    <span class="ml-2 text-sm text-gray-600">{{ label }}</span>
  </label>
</template>

<script lang="ts">
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      label: String,
      modelValue: Boolean,
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
      const change = (e: Event) => {
        emit('update:modelValue', (e.target as HTMLInputElement).checked)
      }

      return { change }
    },
  })
</script>
