<template>
  <div>
    <slot :title="getTitle" />
  </div>
</template>

<script lang="ts">
  import { pageProps as props, pageSetup } from '@admin/mixins/pages'
  import { defineComponent } from 'vue'

  export default defineComponent({
    props,
    setup(props) {
      const initial = pageSetup(props, 'create', 0)

      return { ...initial }
    },
  })
</script>
