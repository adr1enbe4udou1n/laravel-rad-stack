<template>
  <span
    v-if="value"
    class="inline-block px-2 py-1 text-white text-sm rounded bg-gray-400"
    >{{ text ? value[text] : value }}</span
  >
</template>

<script lang="ts">
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      value: {
        type: Object,
        required: true,
      },
      text: String,
    },
  })
</script>
