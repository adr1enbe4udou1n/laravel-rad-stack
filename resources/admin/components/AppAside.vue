<template>
  <div
    class="
      hidden
      md:block
      bg-white
      p-6
      overflow-y-auto
      scrollbar-thin scrollbar-thumb-primary-900 scrollbar-track-gray-100
    "
    :class="[`w-${width}`]"
  >
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
  </div>
</template>

<script lang="ts">
  import { defineComponent, inject } from 'vue'

  export default defineComponent({
    props: {
      title: String,
      width: {
        type: Number,
        default: 96,
      },
    },
    setup() {
      const resource = inject<string>('resource')

      return {
        resource,
      }
    },
  })
</script>
