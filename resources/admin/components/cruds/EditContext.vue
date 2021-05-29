<template>
  <slot :title="getTitle" />
</template>

<script lang="ts">
  import {
    pageWithItemProps as props,
    pageWithItemSetup,
  } from '@admin/mixins/pages'
  import { defineComponent } from 'vue'

  export default defineComponent({
    props,
    setup(props) {
      const initial = pageWithItemSetup(props, 'edit', 0)

      return { ...initial }
    },
  })
</script>
