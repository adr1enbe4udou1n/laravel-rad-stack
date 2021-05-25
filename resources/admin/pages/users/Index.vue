<template>
  <app-layout>
    <template #header>
      <h1>{{ title }}</h1>
    </template>

    Hello from users !
  </app-layout>
</template>

<script lang="ts">
  import { useTitle } from '@admin/features/helpers'
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      users: Object,
    },
    setup() {
      const title = useTitle('crud.users.index.title')

      return { title }
    },
  })
</script>
