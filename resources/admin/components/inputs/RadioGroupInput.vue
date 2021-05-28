<template>
  <input-label :for="id" class="mb-1">{{ getLabel }}</input-label>
  <select
    v-bind="$attrs"
    :id="id"
    class="focus:ring focus:ring-opacity-50 rounded-md shadow-sm block w-full"
    :class="{ 'form-invalid': !!error }"
    :value="modelValue"
    @input="onInput"
  />
  <input-error :message="error" class="mt-2" />
</template>

<script lang="ts">
  import { useUniqueId } from '@admin/features/helpers'
  import { transAttribute } from '@admin/plugins/translations'
  import { computed, defineComponent, inject, ref } from 'vue'

  interface Options {
    text: string
    value: string
  }

  export default defineComponent({
    props: {
      label: String,
      source: String,
      modelValue: String,
      error: String,
      options: [Array, Object] as Options[] | unknown,
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
      const input = ref(null)
      const id = useUniqueId()

      const resource = inject<string>('resource')

      const getLabel = computed(() => {
        if (props.source) {
          return transAttribute(resource, props.source)
        }
        return props.label
      })

      const onInput = (e: any) => {
        emit('update:modelValue', (e.target as HTMLInputElement).value)
      }

      return { id, input, onInput, getLabel }
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
