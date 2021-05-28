<template>
  <show-layout resource="users" :item="user">
    <template #actions>
      <list-button />
      <edit-button />
      <impersonate-button />
      <delete-button />
    </template>
    Hello from show !
  </show-layout>
</template>

<script lang="ts">
  import { User } from '@admin/types'
  import { defineComponent, PropType } from 'vue'

  export default defineComponent({
    props: {
      user: Object as PropType<User>,
    },
  })
</script>
