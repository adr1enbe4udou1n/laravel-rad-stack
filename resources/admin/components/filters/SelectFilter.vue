<template>
  <select @input="onFilter">
    <option value=""></option>
    <option
      v-for="option in getChoices"
      :key="option.value"
      :value="option.value"
      :selected="isSelected(option)"
    >
      {{ option.text }}
    </option>
  </select>
</template>

<script lang="ts">
  import { getOptionsFromChoices, Option } from '@admin/mixins/choices'
  import { computed, defineComponent } from 'vue'

  export default defineComponent({
    props: {
      modelValue: [String, Number, Array],
      choices: [Array, Object, String],
      optionText: {
        type: String,
        default: 'text',
      },
      optionValue: {
        type: String,
        default: 'value',
      },
      multiple: Boolean,
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
      const getChoices = computed((): Option[] => {
        return getOptionsFromChoices(
          props.choices,
          props.optionText,
          props.optionValue
        )
      })

      const onFilter = (e: Event) => {
        emit('update:modelValue', (e.target as HTMLInputElement).value)
      }

      const isSelected = (option: Option) => {
        return props.multiple
          ? ((props.modelValue as string[]) || []).includes(option.value)
          : props.modelValue === option.value
      }

      return { getChoices, onFilter, isSelected }
    },
  })
</script>
