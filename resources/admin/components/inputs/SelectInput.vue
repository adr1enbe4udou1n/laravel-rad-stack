<template>
  <input-label :for="id" class="mb-1">{{ getLabel }}</input-label>
  <select
    v-bind="$attrs"
    :id="id"
    class="block w-full"
    :class="{ 'form-invalid': !!error }"
    :multiple="multiple"
    @input="onInput"
  >
    <option
      v-for="option in getChoices"
      :key="option.value"
      :value="option.value"
      :selected="isSelected(option)"
    >
      {{ option.text }}
    </option>
  </select>
  <input-error :message="error" class="mt-2" />
  <input-hint :message="hint" class="mt-2" />
</template>

<script lang="ts">
  import { choicesProps, choicesSetup, Option } from '@admin/mixins/choices'
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      ...choicesProps,
      modelValue: [String, Number, Array],
      multiple: Boolean,
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
      const initial = choicesSetup(props)

      const onInput = (e: Event) => {
        let { options, value } = e.target as HTMLSelectElement

        if (!props.multiple) {
          return emit('update:modelValue', value)
        }

        const values = Array.from(options)
          .filter((o) => o.selected)
          .map((o) => o.value)

        return emit('update:modelValue', values)
      }

      const isSelected = (option: Option) => {
        return props.multiple
          ? ((props.modelValue as string[]) || []).includes(option.value)
          : props.modelValue === option.value
      }

      return { ...initial, onInput, isSelected }
    },
  })
</script>
