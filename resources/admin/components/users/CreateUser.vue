<template>
  <create-context v-slot="{ title }" resource="users">
    <app-aside :title="title">
      <user-form :method="method" :url="url" />
    </app-aside>
  </create-context>
</template>

<script lang="ts">
  import { defineComponent } from 'vue'
  import route from 'ziggy-js'

  export default defineComponent({
    setup() {
      const method = 'post'
      const url = route('admin.users.store')

      return { method, url }
    },
  })
</script>
