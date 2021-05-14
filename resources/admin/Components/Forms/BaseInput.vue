<template>
  <input
    ref="input"
    class="
      border-gray-300
      focus:border-indigo-300
      focus:ring focus:ring-indigo-200 focus:ring-opacity-50
      rounded-md
      shadow-sm
    "
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  />
</template>

<script lang="ts">
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      modelValue: String,
    },
    emits: ['update:modelValue'],
    methods: {
      focus() {
        ;(this.$refs.input as HTMLInputElement).focus()
      },
    },
  })
</script>
