<template>
  <span>{{ $dateFormat(value, format) }}</span>
</template>

<script lang="ts">
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      value: {
        type: [String, Number],
        required: true,
      },
      format: {
        type: String,
        default: 'dd/MM/yyyy',
      },
    },
  })
</script>
