<template>
  <input-label :for="id" class="mb-1">{{ getLabel }}</input-label>
  <select
    v-bind="$attrs"
    :id="id"
    class="block w-full"
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
