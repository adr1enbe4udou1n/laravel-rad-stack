<template>
  <app-layout>
    <template #header>
      <h1>{{ title }}</h1>
    </template>

    Hello !
  </app-layout>
</template>

<script lang="ts">
  import { useTitle } from '@admin/features/helpers'
  import { defineComponent } from 'vue'

  export default defineComponent({
    setup() {
      const title = useTitle('Dashboard')

      return { title }
    },
  })
</script>
