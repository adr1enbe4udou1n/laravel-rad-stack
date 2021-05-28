<template>
  <app-layout>
    <template #header>
      <div class="flex items-center">
        <h1>{{ getTitle }}</h1>
        <div v-if="$slots.actions" class="flex gap-2 ml-auto">
          <slot name="actions"> </slot>
        </div>
      </div>
    </template>

    <slot />
  </app-layout>
</template>

<script lang="ts">
  import { useModelToString, useTitle } from '@admin/features/helpers'
  import { Model } from '@admin/types'
  import { transChoice } from 'matice'
  import { computed, defineComponent, PropType, provide } from 'vue'

  export default defineComponent({
    props: {
      title: String,
      resource: String,
      item: Object as PropType<Model>,
    },
    setup(props) {
      const getTitle = computed(() => {
        return (
          props.title ||
          useTitle('admin.titles.edit', {
            args: {
              resource: transChoice(
                `crud.${props.resource}.name`,
                0
              ).toLowerCase(),
              label: useModelToString(props.resource, props.item),
              id: props.item.id,
            },
          })
        )
      })

      provide('resource', props.resource)
      provide('item', props.item)

      return { getTitle }
    },
  })
</script>
