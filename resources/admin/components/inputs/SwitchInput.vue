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
  import { transAttribute } from '@admin/plugins/translations'
  import { computed, defineComponent, inject, ref } from 'vue'

  export default defineComponent({
    props: {
      label: String,
      source: String,
      modelValue: Boolean,
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
      const resource = inject<string>('resource')

      const getLabel = computed(() => {
        if (props.source) {
          return transAttribute(resource, props.source)
        }
        return props.label
      })

      const change = (e: Event) => {
        emit('update:modelValue', (e.target as HTMLInputElement).checked)
      }

      return { change, getLabel }
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
