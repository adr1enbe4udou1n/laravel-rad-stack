<template>
  <teleport to="head">
    <title>{{ $title('Login') }}</title>
  </teleport>
  <auth-card>Test</auth-card>
</template>

<script lang="ts">
  import { defineComponent } from 'vue'

  export default defineComponent({})
</script>
