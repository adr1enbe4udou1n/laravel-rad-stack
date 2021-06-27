<template>
  <create-context v-slot="{ title }" resource="posts">
    <app-layout>
      <template #header>
        <page-header>
          <h1>{{ title }}</h1>
          <template #actions>
            <list-button />
          </template>
        </page-header>
      </template>

      <post-form :method="method" :url="url" />
    </app-layout>
  </create-context>
</template>

<script lang="ts">
  import { defineComponent } from 'vue'
  import route from 'ziggy-js'

  export default defineComponent({
    setup() {
      const method = 'post'
      const url = route('admin.posts.store')

      return { method, url }
    },
  })
</script>
