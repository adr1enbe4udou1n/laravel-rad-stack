import { Inertia } from '@inertiajs/inertia'
import { usePage } from '@inertiajs/inertia-vue3'
import { computed, ExtractPropTypes } from 'vue'
import { inputProps, inputSetup } from './input'

export const choicesProps = {
  ...inputProps,
  choices: [Array, Object, String],
  optionText: {
    type: String,
    default: 'text',
  },
  optionValue: {
    type: String,
    default: 'value',
  },
  allowEmpty: Boolean,
  emptyText: String,
}

export interface Option {
  value: string
  text: string | undefined
}

export const getOptionsFromChoices = (
  choices: any,
  optionText: string,
  optionValue: string
) => {
  if (Array.isArray(choices)) {
    return choices.map((o: any) => {
      return { value: o[optionValue], text: o[optionText] }
    })
  }

  if (typeof choices === 'string') {
    choices = (usePage<Inertia.PageProps>().props.value.enums as any)[choices]
  }

  return Object.keys(choices).map((key) => {
    return { value: key, text: (choices as any)[key] }
  })
}

export const choicesSetup = (
  props: Readonly<ExtractPropTypes<typeof choicesProps>>
) => {
  const initial = inputSetup(props)

  const getChoices = computed((): Option[] => {
    let options = getOptionsFromChoices(
      props.choices,
      props.optionText,
      props.optionValue
    )

    if (props.allowEmpty) {
      options = [{ value: '', text: props.emptyText }, ...options]
    }

    return options
  })

  return { ...initial, getChoices }
}
