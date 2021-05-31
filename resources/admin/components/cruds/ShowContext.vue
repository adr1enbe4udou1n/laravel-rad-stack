<template>
  <div>
    <slot :title="getTitle" />
  </div>
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
      const initial = pageWithItemSetup(props, 'show', 0)

      return { ...initial }
    },
  })
</script>
