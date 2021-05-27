<template>
  <app-layout>
    <template #header>
      <h1>{{ title }}</h1>
    </template>
  </app-layout>
</template>

<script lang="ts">
  import { useTitle } from '@admin/features/helpers'
  import { User } from '@admin/types'
  import { defineComponent, PropType } from 'vue'

  export default defineComponent({
    props: {
      user: Object as PropType<User>,
    },
    setup(props) {
      const title = useTitle('crud.users.titles.show', { args: props.user })

      return { title }
    },
  })
</script>
