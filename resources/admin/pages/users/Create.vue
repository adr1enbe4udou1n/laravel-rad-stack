<template>
  <app-layout>
    <template #header>
      <h1>{{ title }}</h1>
    </template>

    Hello from create user !
  </app-layout>
</template>

<script lang="ts">
  import { useTitle } from '@admin/features/helpers'
  import { defineComponent } from 'vue'

  export default defineComponent({
    setup() {
      const title = useTitle('crud.users.titles.create')

      return { title }
    },
  })
</script>
