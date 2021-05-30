<template>
  <header class="flex items-center mb-8">
    <h2 class="font-semibold text-gray-800 leading-tight w-3/4">
      {{ title }}
    </h2>

    <inertia-link
      :href="route(`admin.${resource}`)"
      class="inline-block p-2 text-white rounded-full bg-primary-500 ml-auto"
      :only="['action']"
    >
      <x-icon class="h-5 w-5" />
    </inertia-link>
  </header>
  <slot />
</template>

<script lang="ts">
  import { defineComponent, inject } from 'vue'

  export default defineComponent({
    props: {
      title: String,
    },
    setup() {
      const resource = inject<string>('resource')

      return {
        resource,
      }
    },
  })
</script>
