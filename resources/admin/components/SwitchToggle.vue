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
    <div v-if="label" class="ml-2 text-gray-700 text-sm font-medium">
      {{ label }}
    </div>
  </label>
</template>

<script lang="ts">
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      modelValue: Boolean,
      label: String,
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

<style lang="postcss" scoped>
  input:checked ~ .dot {
    @apply translate-x-4;
  }

  input:checked ~ .bg-toggle {
    @apply bg-primary-500;
  }
</style>
