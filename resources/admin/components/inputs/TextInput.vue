<template>
  <input-label :for="id" class="mb-1" :value="getLabel" />
  <input
    v-bind="$attrs"
    :id="id"
    ref="input"
    class="
      focus:ring focus:ring-opacity-50 focus:ring-primary-500
      rounded-md
      shadow-sm
      block
      w-full
      px-3
      py-2
      !border-primary-300
    "
    :class="{ 'form-invalid': !!error }"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  />
  <input-error :message="error" class="mt-2" />
</template>

<script lang="ts">
  import { defineComponent, ref } from 'vue'
  import { inputProps, inputSetup } from '@admin/mixins/input'

  export default defineComponent({
    props: {
      ...inputProps,
      modelValue: String,
    },
    emits: ['update:modelValue'],
    setup(props) {
      const input = ref(null)
      const initial = inputSetup(props)

      const focus = () => {
        input.value?.focus()
      }

      return { ...initial, focus, input }
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
