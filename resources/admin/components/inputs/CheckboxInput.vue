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
    <span class="ml-2 text-sm text-gray-600">{{ getLabel }}</span>
  </label>
</template>

<script lang="ts">
  import { transAttribute } from '@admin/plugins/translations'
  import { computed, defineComponent, inject } from 'vue'

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
