<template>
  <div>
    <component
      :is="href ? 'inertia-link' : 'button'"
      :href="href"
      :class="[...classes]"
    >
      <slot></slot>
    </component>
  </div>
</template>

<script lang="ts">
  import { computed, defineComponent } from 'vue'

  export default defineComponent({
    props: {
      active: Boolean,
      href: String,
    },
    setup(props) {
      const classes = computed(() => [
        props.href ? '' : 'text-left w-full',
        props.active
          ? 'block pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition'
          : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition',
      ])

      return { classes }
    },
  })
</script>
