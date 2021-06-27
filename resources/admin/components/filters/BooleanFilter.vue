<template>
  <select-filter v-model="value" :choices="choices" />
</template>

<script lang="ts">
  import { __ } from 'matice'
  import { computed, defineComponent } from 'vue'

  export default defineComponent({
    props: {
      modelValue: String,
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
      const choices = {
        1: __('admin.yes'),
        0: __('admin.no'),
      }

      const value = computed({
        get: () => props.modelValue,
        set: (val) => emit('update:modelValue', val),
      })

      return { choices, value }
    },
  })
</script>
