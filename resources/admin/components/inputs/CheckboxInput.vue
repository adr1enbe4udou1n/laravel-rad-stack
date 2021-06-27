<template>
  <label class="flex items-center">
    <input type="checkbox" :checked="modelValue" @change="change" />
    <span class="ml-2 text-sm text-gray-600">{{ getLabel }}</span>
  </label>
  <input-error :message="error" class="mt-2" />
  <input-hint :message="hint" class="mt-2" />
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
