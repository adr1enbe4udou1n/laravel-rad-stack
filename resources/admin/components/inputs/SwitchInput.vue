<template>
  <label class="flex items-center cursor-pointer">
    <!-- toggle -->
    <div class="relative">
      <!-- input -->
      <input
        type="checkbox"
        class="sr-only"
        :checked="modelValue"
        @change="change"
      />
      <!-- line -->
      <div class="bg-toggle block bg-gray-400 w-10 h-6 rounded-full"></div>
      <!-- dot -->
      <div
        class="
          dot
          absolute
          left-1
          top-1
          bg-white
          w-4
          h-4
          rounded-full
          transition
          transform
        "
      ></div>
    </div>
    <!-- label -->
    <div class="ml-2 text-gray-700 text-sm font-medium">
      {{ getLabel }}
    </div>
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

<style lang="postcss" scoped>
  input:checked ~ .dot {
    @apply translate-x-4;
  }

  input:checked ~ .bg-toggle {
    @apply bg-primary-500;
  }
</style>
