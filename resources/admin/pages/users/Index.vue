<template>
  <app-layout>
    <template #header>
      <h1>{{ $t('crud.users.index.title') }}</h1>
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
      useTitle('crud.users.index.title')
    },
  })
</script>
