<template>
  <input-label :for="id" class="mb-1" :value="getLabel" />
  <input
    v-bind="$attrs"
    :id="id"
    ref="input"
    class="focus:ring focus:ring-opacity-50 rounded-md shadow-sm block w-full"
    :class="{ 'form-invalid': !!error }"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  />
  <input-error :message="error" class="mt-2" />
</template>

<script lang="ts">
  import { useUniqueId } from '@admin/features/helpers'
  import { transAttribute } from '@admin/plugins/translations'
  import { computed, defineComponent, inject, ref } from 'vue'

  export default defineComponent({
    props: {
      label: String,
      source: String,
      modelValue: String,
      error: String,
    },
    emits: ['update:modelValue'],
    setup(props) {
      const input = ref(null)
      const id = useUniqueId()

      const resource = inject<string>('resource')

      const getLabel = computed(() => {
        if (props.source) {
          return transAttribute(resource, props.source)
        }
        return props.label
      })

      const focus = () => {
        input.value?.focus()
      }

      return { id, focus, input, getLabel }
    },
  })
</script>

<style lang="postcss" scoped>
  input {
    @apply border-gray-300 focus:border-indigo-300 focus:ring-indigo-200;

    &.form-invalid {
      @apply border-red-500 focus:border-red-300 focus:ring-red-200;
    }
  }
</style>
