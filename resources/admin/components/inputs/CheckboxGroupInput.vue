<template>
  <input-label class="mb-1">{{ getLabel }}</input-label>
  <div class="flex" :class="{ 'flex-col gap-1': stacked, 'gap-4': !stacked }">
    <label
      v-for="option in getChoices"
      :key="option.value"
      class="flex items-center text-sm whitespace-nowrap"
    >
      <input
        type="checkbox"
        :name="getName"
        :value="option.value"
        class="checked:bg-primary-500 mr-2"
        :checked="modelValue?.includes(option.value)"
        @input="onInput"
      />
      {{ option.text }}
    </label>
  </div>
  <input-error :message="getError" class="mt-2" />
  <input-hint :message="hint" class="mt-2" />
</template>

<script lang="ts" setup>
  import { choicesProps, choicesSetup } from '@admin/mixins/choices'

  const props = defineProps({
    ...choicesProps,
    stacked: Boolean,
  })

  const { getLabel, getChoices, getName, modelValue, getError } =
    choicesSetup(props)

  const onInput = (e: Event) => {
    const { checked, value } = e.target as HTMLInputElement

    if (checked) {
      modelValue.value = [...(modelValue.value || []), value]
    }

    modelValue.value = modelValue.value?.filter((v) => v !== value)
  }
</script>
