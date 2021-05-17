<template>
  <label class="flex items-center">
    <input
      type="checkbox"
      :checked="modelValue"
      class="
        rounded
        border-gray-300
        text-indigo-600
        shadow-sm
        focus:border-indigo-300
        focus:ring focus:ring-indigo-200 focus:ring-opacity-50
      "
      @change="$emit('update:modelValue', $event.target.checked)"
    />
    <span class="ml-2 text-sm text-gray-600">{{ label }}</span>
  </label>
</template>

<script lang="ts">
  import { useUniqueId } from '@admin/features/helpers'
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      label: String,
      modelValue: Boolean,
    },
    emits: ['update:modelValue'],
    setup() {
      const id = useUniqueId()

      return { id }
    },
  })
</script>
