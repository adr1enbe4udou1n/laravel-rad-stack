<template>
  <base-label v-if="label" :for="id" class="mb-1">{{ label }}</base-label>
  <input
    v-bind="$attrs"
    :id="id"
    ref="input"
    class="focus:ring focus:ring-opacity-50 rounded-md shadow-sm block w-full"
    :class="stateClasses"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  />
  <input-error :message="error" class="mt-2" />
</template>

<script lang="ts">
  import { useUniqueId } from '@admin/features/helpers'
  import { computed, defineComponent, ref } from 'vue'

  export default defineComponent({
    props: {
      label: String,
      modelValue: String,
      error: String,
    },
    emits: ['update:modelValue'],
    setup(props) {
      const input = ref(null)
      const id = useUniqueId()

      const focus = () => {
        input.value?.focus()
      }

      const stateClasses = computed(() => {
        return props.error
          ? 'border-red-500 focus:border-red-300 focus:ring-red-200'
          : 'border-gray-300 focus:border-primary-300 focus:ring-primary-200'
      })

      return { id, focus, input, stateClasses }
    },
  })
</script>
