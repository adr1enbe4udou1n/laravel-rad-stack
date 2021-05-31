<template>
  <a :href="`mailto:${value}`" class="underline" @click.stop>{{ value }}</a>
</template>

<script lang="ts">
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      value: {
        type: String,
        required: true,
      },
    },
  })
</script>
