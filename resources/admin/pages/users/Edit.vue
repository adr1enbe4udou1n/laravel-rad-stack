<template>
  <app-layout>
    <template #header>
      <h1>{{ $t('Users') }}</h1>
    </template>

    Hello from edit user {{ user.name }} !
  </app-layout>
</template>

<script lang="ts">
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      user: Object,
    },
    //setup() {},
  })
</script>
