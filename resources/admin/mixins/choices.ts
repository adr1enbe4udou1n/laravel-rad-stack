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
  choices: unknown,
  optionText: string,
  optionValue: string
) => {
  let options = choices as Option[]

  if (typeof options === 'string') {
    options = usePage<Inertia.PageProps>().props.value.enums[options]
  }

  if (typeof options === 'object') {
    options = Object.keys(options).map((key) => {
      return { value: key, text: (options as any)[key] }
    })
  }

  if (Array.isArray(options)) {
    options = options.map((o: any) => {
      return { value: o[optionValue], text: o[optionText] }
    })
  }

  return options
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
