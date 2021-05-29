<template>
  <input-label class="mb-1">{{ getLabel }}</input-label>
  <div class="flex" :class="{ 'flex-col gap-1': stacked, 'gap-4': !stacked }">
    <label
      v-for="option in getChoices"
      :key="option.value"
      class="flex items-center text-sm whitespace-nowrap"
    >
      <input
        type="radio"
        :name="source"
        :value="option.value"
        class="checked:bg-primary-500 mr-2"
        :checked="modelValue === option.value"
        @input="onInput"
      />
      {{ option.text }}
    </label>
  </div>
  <input-error :message="error" class="mt-2" />
</template>

<script lang="ts">
  import { choicesProps, choicesSetup } from '@admin/mixins/choices'
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      ...choicesProps,
      modelValue: String,
      stacked: Boolean,
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
      const initial = choicesSetup(props)

      const onInput = (e: any) => {
        emit('update:modelValue', (e.target as HTMLInputElement).value)
      }

      return { ...initial, onInput }
    },
  })
</script>
