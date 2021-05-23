<template>
  <button
    class="
      px-4
      py-2
      border border-transparent
      rounded-md
      font-semibold
      text-xs
      uppercase
      tracking-widest
      active:bg-gray-900
      focus:outline-none
      focus:ring
      disabled:opacity-25
      transition
    "
    :class="[classes, { 'opacity-25': loading }]"
    :disabled="loading"
  >
    <slot></slot>
  </button>
</template>

<script lang="ts">
  import { computed, defineComponent } from 'vue'

  export default defineComponent({
    props: {
      loading: Boolean,
      color: {
        type: String,
        default: 'default',
      },
    },
    setup(props) {
      const classes = computed(() => {
        return {
          default:
            'bg-gray-800 hover:bg-gray-700 focus:border-gray-900 focus:ring-gray-300 text-white',
          danger:
            'bg-red-600 hover:bg-red-500 focus:border-red-700 focus:ring-red-200 active:bg-red-600 text-white',
          secondary:
            'bg-white border-gray-300 text-gray-700 shadow-sm hover:text-gray-500 focus:border-blue-300 focus:ring-blue-200 active:text-gray-800 active:bg-gray-50',
        }[props.color]
      })

      return { classes }
    },
  })
</script>
