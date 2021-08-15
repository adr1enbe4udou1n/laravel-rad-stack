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
  targetSource: String,
  hint: String,
  defaultValue: [String, Number, Array, Object],
  getter: Function,
}

export const inputSetup = (
  props: Readonly<ExtractPropTypes<typeof inputProps>>,
  setValue = true
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

  const getTargetSource = computed(() => {
    return props.targetSource || props.source!
  })

  const getErrors = computed(() => {
    return form!.errors
  })

  const getError = computed(() => {
    if (form!.errors && form!.errors[getTargetSource.value]) {
      return form!.errors[getTargetSource.value]
    }
    return ''
  })

  const hasError = computed(() => {
    return !!getError.value
  })

  const getInitialValue = computed(() => {
    if (!form || !form.initial) return props.defaultValue
    return props.getter
      ? props.getter(form.initial)
      : get(form.initial, props.source!)
  })

  if (form && setValue) {
    set(form.data, getTargetSource.value, getInitialValue.value)
  }

  const modelValue = computed({
    get: () => get(form!.data, getTargetSource.value),
    set: (val) => set(form!.data, getTargetSource.value, val),
  })

  return {
    id,
    getLabel,
    getName,
    hasError,
    getError,
    getErrors,
    getInitialValue,
    getTargetSource,
    modelValue,
    form,
  }
}
