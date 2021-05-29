import {
  useModelToString,
  useTitle,
  useUniqueId,
} from '@admin/features/helpers'
import { transAttribute } from '@admin/plugins/translations'
import { Model } from '@admin/types'
import { transChoice } from 'matice'
import { computed, inject, ExtractPropTypes, PropType, provide } from 'vue'

export const pageProps = {
  title: String,
  resource: String,
  item: Object as PropType<Model>,
}

export const pageWithItemProps = {
  ...pageProps,
  item: Object as PropType<Model>,
}

export const pageSetup = (
  props: Readonly<ExtractPropTypes<typeof pageProps>>,
  name: string,
  count: number,
  args: { [key: string]: any } = {}
) => {
  const getTitle = computed(() => {
    return (
      props.title ||
      useTitle(`admin.titles.${name}`, {
        args: {
          resource: transChoice(
            `crud.${props.resource}.name`,
            count
          ).toLowerCase(),
          ...args,
        },
      })
    )
  })

  provide('resource', props.resource)

  return { getTitle }
}

export const pageWithItemSetup = (
  props: Readonly<ExtractPropTypes<typeof pageWithItemProps>>,
  name: string,
  count: number
) => {
  const initialSetup = pageSetup(props, name, count, {
    label: useModelToString(props.resource, props.item),
    id: props.item.id,
  })

  provide('item', props.item)

  return { ...initialSetup }
}
