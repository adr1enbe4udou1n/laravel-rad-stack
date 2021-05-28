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
  import { useTitle } from '@admin/features/helpers'
  import { transChoice } from 'matice'
  import { computed, defineComponent, provide } from 'vue'

  export default defineComponent({
    props: {
      title: String,
      resource: String,
    },
    setup(props) {
      const getTitle = computed(() => {
        return (
          props.title ||
          useTitle('admin.titles.index', {
            args: {
              resource: transChoice(
                `crud.${props.resource}.name`,
                10
              ).toLowerCase(),
            },
          })
        )
      })

      provide('resource', props.resource)

      return { getTitle }
    },
  })
</script>
