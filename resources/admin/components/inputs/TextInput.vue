<template>
  <input-label :for="id" class="mb-1" :value="getLabel" />
  <input
    v-bind="$attrs"
    :id="id"
    ref="input"
    class="block w-full"
    :class="{ 'form-invalid': !!error }"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  />
  <input-error :message="error" class="mt-2" />
</template>

<script lang="ts">
  import { defineComponent, ref } from 'vue'
  import { inputProps, inputSetup } from '@admin/mixins/input'

  export default defineComponent({
    props: {
      ...inputProps,
      modelValue: String,
    },
    emits: ['update:modelValue'],
    setup(props) {
      const input = ref(null)
      const initial = inputSetup(props)

      const focus = () => {
        input.value?.focus()
      }

      return { ...initial, focus, input }
    },
  })
</script>
