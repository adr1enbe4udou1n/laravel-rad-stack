<template>
  <span
    v-if="label"
    class="inline-block px-2 py-1 text-white text-sm rounded"
    :class="variant || 'bg-primary-500'"
    >{{ label }}</span
  >
</template>

<script lang="ts">
  import { usePage } from '@inertiajs/inertia-vue3'
  import { computed, defineComponent } from 'vue'
  import { enumVariants } from '@admin/types/enums'

  export default defineComponent({
    props: {
      value: {
        type: String,
        required: true,
      },
      choices: {
        type: [String, Array],
        required: true,
      },
    },
    setup(props) {
      const label = computed(() => {
        let options = props.choices

        if (typeof options === 'string') {
          options = (usePage().props.value.enums as any)[
            props.choices as string
          ]
        }
        return (options as any)[props.value]
      })

      const variant = computed(() => {
        if (typeof props.choices !== 'string') return null

        const variant = (enumVariants as any)[props.choices]

        if (variant) {
          return variant[props.value]
        }
        return null
      })

      return { label, variant }
    },
  })
</script>
