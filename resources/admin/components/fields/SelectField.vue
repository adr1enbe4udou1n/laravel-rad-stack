<template>
  <span
    class="inline-block px-2 py-1 bg-primary-500 text-white text-sm rounded"
    >{{ label }}</span
  >
</template>

<script lang="ts">
  import { usePage } from '@inertiajs/inertia-vue3'
  import { computed, defineComponent } from 'vue'

  export default defineComponent({
    props: {
      value: String,
      options: [String, Array],
    },
    setup(props) {
      const label = computed(() => {
        let options = props.options

        if (typeof options === 'string') {
          options = usePage().props.value.enums[props.options]
        }
        return options[props.value]
      })
      return { label }
    },
  })
</script>
