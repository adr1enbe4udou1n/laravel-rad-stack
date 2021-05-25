<template>
  <app-layout>
    <template #header>
      <h1>{{ $t('crud.users.create.title') }}</h1>
    </template>

    Hello from create user !
  </app-layout>
</template>

<script lang="ts">
  import { useTitle } from '@admin/features/helpers'
  import { defineComponent } from 'vue'

  export default defineComponent({
    setup() {
      useTitle('crud.users.create.title')
    },
  })
</script>
