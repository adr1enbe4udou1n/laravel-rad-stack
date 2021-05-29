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
  import { pageProps as props, pageSetup } from '@admin/mixins/pages'
  import { defineComponent } from 'vue'

  export default defineComponent({
    props,
    setup(props) {
      const initial = pageSetup(props, 'index', 10)

      return { ...initial }
    },
  })
</script>
