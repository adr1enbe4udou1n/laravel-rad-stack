<template>
  <form @submit.prevent="$emit('submit')">
    <slot />
  </form>
</template>

<script lang="ts">
  import { InertiaForm } from '@inertiajs/inertia-vue3'
  import { defineComponent, provide } from 'vue'

  export default defineComponent({
    props: {
      form: Object as InertiaForm<any>,
    },
    emits: ['submit'],
    setup(props) {
      provide('form', props.form)
    },
  })
</script>
