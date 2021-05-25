<template>
  <inertia-link
    :href="href"
    class="
      inline-flex
      items-center
      px-1
      pt-1
      border-b-2
      text-sm
      font-medium
      leading-5
      focus:outline-none
      transition
    "
    :class="{ active }"
  >
    <component :is="`${icon}-icon`" v-if="icon" class="w-4 h-4 mr-2" />
    <slot></slot>
  </inertia-link>
</template>

<script lang="ts">
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      href: String,
      icon: String,
      active: Boolean,
    },
  })
</script>

<style lang="postcss" scoped>
  .active {
    @apply text-gray-900 border-primary-400 focus:border-primary-700;
  }
  :not(.active) {
    @apply border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:text-gray-700 focus:border-gray-300;
  }
</style>
