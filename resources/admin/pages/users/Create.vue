<template>
  <create-layout resource="users">
    <template #actions>
      <list-button />
    </template>

    <div class="max-w-2xl mx-auto">
      <user-form :method="method" :url="url" />
    </div>
  </create-layout>
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
