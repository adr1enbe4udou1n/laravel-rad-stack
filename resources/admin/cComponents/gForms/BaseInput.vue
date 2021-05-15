<template>
  <base-label v-if="label" :for="id" class="mb-1">{{ label }}</base-label>
  <input
    v-bind="$attrs"
    :id="id"
    ref="input"
    class="
      border-gray-300
      focus:border-indigo-300
      focus:ring focus:ring-indigo-200 focus:ring-opacity-50
      rounded-md
      shadow-sm
      block
      w-full
    "
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  />
</template>

<script lang="ts">
  import { defineComponent, ref } from 'vue'
  import uniqueId from '../../Features/UniqueId'

  export default defineComponent({
    props: {
      label: String,
      modelValue: String,
    },
    emits: ['update:modelValue'],
    setup() {
      const input = ref(null)
      const id = uniqueId()

      const focus = () => {
        input.value.focus()
      }

      return { id, focus, input }
    },
  })
</script>
