<template>
  <input-label :for="id" class="mb-1" :value="getLabel" />
  <textarea
    v-if="multiline"
    v-bind="$attrs"
    :id="id"
    ref="input"
    v-model="modelValue"
    :name="getName"
    class="block w-full"
    :class="{ 'form-invalid': hasError }"
  />
  <input
    v-else
    v-bind="$attrs"
    :id="id"
    ref="input"
    v-model="modelValue"
    :name="getName"
    class="block w-full"
    :class="{ 'form-invalid': hasError }"
  />
  <input-error :message="getError" class="mt-2" />
  <input-hint :message="hint" class="mt-2" />
</template>

<script lang="ts" setup>
  import { Ref, ref } from 'vue'
  import { inputProps, inputSetup } from '@admin/mixins/input'

  const props = defineProps({
    ...inputProps,
    multiline: Boolean,
    defaultValue: {
      type: String,
      default: '',
    },
  })

  const input: Ref<HTMLInputElement | null> = ref(null)
  const { getLabel, modelValue, getError, hasError, id, getName } =
    inputSetup(props)

  const focus = () => {
    input.value?.focus()
  }

  defineExpose({ focus })
</script>
