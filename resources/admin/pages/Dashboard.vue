<template>
  <app-layout>
    <template #header>
      <h1>{{ $t('Dashboard') }}</h1>
    </template>

    Hello !
  </app-layout>
</template>

<script lang="ts">
  import { useTitle } from '@admin/features/helpers'
  import { defineComponent } from 'vue'

  export default defineComponent({
    setup() {
      useTitle('Dashboard')
    },
  })
</script>
