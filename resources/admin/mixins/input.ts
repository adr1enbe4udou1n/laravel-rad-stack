import { useUniqueId } from '@admin/features/helpers'
import { transAttribute } from '@admin/plugins/translations'
import { computed, inject, ExtractPropTypes } from 'vue'

export const inputProps = {
  label: String,
  source: String,
  error: String,
}

export const inputSetup = (
  props: Readonly<ExtractPropTypes<typeof inputProps>>
) => {
  const id = useUniqueId()

  const getLabel = computed(() => {
    if (props.source) {
      const resource = inject<string>('resource')
      return transAttribute(resource, props.source)
    }
    return props.label
  })

  return { id, getLabel }
}
