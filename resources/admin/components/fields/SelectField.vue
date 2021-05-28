<template>
  <span
    class="inline-block px-2 py-1 bg-primary-500 text-white text-sm rounded"
    >{{ label }}</span
  >
</template>

<script lang="ts">
  import { usePage } from '@inertiajs/inertia-vue3'
  import { computed, defineComponent } from 'vue'
  import { Inertia } from '@inertiajs/inertia'

  export default defineComponent({
    props: {
      value: String,
      choices: [String, Array],
    },
    setup(props) {
      const label = computed(() => {
        let options = props.choices

        if (typeof options === 'string') {
          options =
            usePage<Inertia.PageProps>().props.value.enums[
              props.choices as string
            ]
        }
        return options[props.value]
      })
      return { label }
    },
  })
</script>
