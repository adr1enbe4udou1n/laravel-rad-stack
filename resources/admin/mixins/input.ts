import { useUniqueId } from '@admin/features/helpers'
import { transAttribute } from '@admin/plugins/translations'
import last from 'lodash/last'
import get from 'lodash/get'
import set from 'lodash/set'
import { computed, ExtractPropTypes, inject } from 'vue'

export const inputProps = {
  label: String,
  source: {
    type: String,
    required: true,
  },
  hint: String,
  defaultValue: [String, Number, Array, Object],
}

export const inputSetup = (
  props: Readonly<ExtractPropTypes<typeof inputProps>>
) => {
  const id = useUniqueId()
  const form = inject<null | { initial; data; errors }>('form', null)

  const getLabel = computed(() => {
    if (props.source) {
      return transAttribute(last<string>(props.source.split('.')) || '')
    }
    return props.label
  })

  const getName = computed(() => {
    return props.source
  })

  const getErrors = computed(() => {
    return form!.errors
  })

  const getError = computed(() => {
    if (form!.errors && props.source && form!.errors[props.source]) {
      return form!.errors[props.source]
    }
    return ''
  })

  const hasError = computed(() => {
    return !!getError.value
  })

  if (form) {
    set(
      form.data,
      props.source!,
      form.initial ? get(form.initial, props.source!) : props.defaultValue
    )
  }

  const modelValue = computed({
    get: () => get(form!.data, props.source!),
    set: (val) => set(form!.data, props.source!, val),
  })

  return { id, getLabel, getName, hasError, getError, getErrors, modelValue }
}
