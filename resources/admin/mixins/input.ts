import { InertiaForm } from '@inertiajs/inertia-vue3'
import { useUniqueId } from '@admin/features/helpers'
import { transAttribute } from '@admin/plugins/translations'
import last from 'lodash/last'
import { computed, ExtractPropTypes, inject } from 'vue'

export const inputProps = {
  label: String,
  source: String,
  hint: String,
}

export const inputSetup = (
  props: Readonly<ExtractPropTypes<typeof inputProps>>
) => {
  const id = useUniqueId()
  const form = inject<InertiaForm<any>>('form', null)

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
    return form?.errors
  })

  const getError = computed(() => {
    if (form?.errors && props.source && form?.errors[props.source]) {
      return form?.errors[props.source]
    }
    return ''
  })

  const hasError = computed(() => {
    return !!getError.value
  })

  return { id, getLabel, getName, hasError, getError, getErrors }
}
