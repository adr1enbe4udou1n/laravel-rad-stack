<template>
  <app-layout>
    <template #header>
      <h1>{{ title }}</h1>
    </template>
  </app-layout>
</template>

<script lang="ts">
  import { useTitle } from '@admin/features/helpers'
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      user: Object,
    },
    setup(props) {
      const title = useTitle('crud.users.edit.title', { args: props.user })

      return { title }
    },
  })
</script>
