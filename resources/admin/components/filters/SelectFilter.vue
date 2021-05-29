<template>
  <select :value="modelValue" @input="onFilter">
    <option value=""></option>
    <option
      v-for="option in getChoices"
      :key="option.value"
      :value="option.value"
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
      modelValue: String,
      choices: [Array, Object, String],
      optionText: {
        type: String,
        default: 'text',
      },
      optionValue: {
        type: String,
        default: 'value',
      },
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

      return { getChoices, onFilter }
    },
  })
</script>
