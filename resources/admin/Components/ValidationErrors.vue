<template>
  <div v-if="hasErrors" class="bg-red-500 rounded-md p-3">
    <ul class="text-sm text-white">
      <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
    </ul>
  </div>
</template>

<script lang="ts">
  import { defineComponent, computed } from 'vue'
  import { usePage } from '@inertiajs/inertia-vue3'

  export default defineComponent({
    setup() {
      const errors = computed(() => (usePage().props.value as any).errors)
      const hasErrors = computed(() => Object.keys(errors.value).length > 0)

      return {
        errors,
        hasErrors,
      }
    },
  })
</script>
