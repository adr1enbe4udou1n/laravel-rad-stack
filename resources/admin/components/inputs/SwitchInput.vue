<template>
  <switch-toggle v-model="value" :label="getLabel" :name="getName" />
  <input-error :message="getError" class="mt-2" />
  <input-hint :message="hint" class="mt-2" />
</template>

<script lang="ts">
  import { inputProps, inputSetup } from '@admin/mixins/input'
  import { computed, defineComponent } from 'vue'

  export default defineComponent({
    props: {
      ...inputProps,
      modelValue: Boolean,
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
      const initial = inputSetup(props)

      const value = computed({
        get: () => props.modelValue,
        set: (val) => emit('update:modelValue', val),
      })

      return { ...initial, value }
    },
  })
</script>
