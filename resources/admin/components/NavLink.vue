<template>
  <inertia-link :href="href" :class="classes">
    <slot></slot>
  </inertia-link>
</template>

<script lang="ts">
  import { computed, defineComponent } from 'vue'

  export default defineComponent({
    props: {
      href: String,
      active: Boolean,
    },
    setup(props) {
      const classes = computed(() =>
        props.active
          ? 'inline-flex items-center px-1 pt-1 border-b-2 border-primary-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-primary-700 transition'
          : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition'
      )

      return { classes }
    },
  })
</script>
