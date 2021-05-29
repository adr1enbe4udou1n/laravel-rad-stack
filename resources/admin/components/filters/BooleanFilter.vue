<template>
  <select :value="modelValue" @input="onFilter">
    <option value=""></option>
    <option value="1">
      {{ $t('admin.yes') }}
    </option>
    <option value="0">
      {{ $t('admin.no') }}
    </option>
  </select>
</template>

<script lang="ts">
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      modelValue: [String, Number],
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
