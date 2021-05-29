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
  text: string
}

export const choicesSetup = (
  props: Readonly<ExtractPropTypes<typeof choicesProps>>
) => {
  const initialInput = inputSetup(props)

  const getChoices = computed((): Option[] => {
    let options = props.choices as Option[]

    if (typeof options === 'string') {
      options =
        usePage<Inertia.PageProps>().props.value.enums[options as string]
    }

    if (typeof options === 'object') {
      options = Object.keys(options).map((key) => {
        return { value: key, text: options[key] }
      })
    }

    if (Array.isArray(options)) {
      options = options.map((o) => {
        return { value: o[props.optionValue], text: o[props.optionText] }
      })
    }

    if (props.allowEmpty) {
      options = [{ value: '', text: props.emptyText }, ...options]
    }

    return options
  })

  return { ...initialInput, getChoices }
}
