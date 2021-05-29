<template>
  <input :value="modelValue" type="text" @input="onFilter" />
</template>

<script lang="ts">
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      modelValue: String,
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
      const onFilter = (e: Event) => {
        emit('update:modelValue', (e.target as HTMLInputElement).value)
      }

      return { onFilter }
    },
  })
</script>
