<template>
  <input-label class="mb-1" :value="getLabel" />
  <disclosure
    v-model="modelValue"
    :item-text="itemText"
    editable
    :new-item="newItem"
    :group="source"
  >
    <template #default="{ index }">
      <slot :index="index" />
    </template>
  </disclosure>
</template>

<script lang="ts" setup>
  import { inputProps, inputSetup } from '@admin/mixins/input'

  const props = defineProps({
    ...inputProps,
    defaultValue: {
      type: Array,
      default: () => [],
    },
    itemText: String,
    newItem: Object,
  })

  const { getLabel, modelValue } = inputSetup(props)
</script>
