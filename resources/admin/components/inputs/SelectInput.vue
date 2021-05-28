<template>
  <input-label :for="id" class="mb-1">{{ getLabel }}</input-label>
  <select
    v-bind="$attrs"
    :id="id"
    class="
      focus:ring focus:ring-primary-500 focus:ring-opacity-50
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
    @input="onInput"
  >
    <option
      v-for="option in getChoices"
      :key="option.value"
      :value="option.value"
    >
      {{ option.text }}
    </option>
  </select>
  <input-error :message="error" class="mt-2" />
</template>

<script lang="ts">
  import { choicesProps, choicesSetup } from '@admin/mixins/choices'
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      ...choicesProps,
      modelValue: String,
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
      const initial = choicesSetup(props)

      const onInput = (e: any) => {
        emit('update:modelValue', (e.target as HTMLInputElement).value)
      }

      return { ...initial, onInput }
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
