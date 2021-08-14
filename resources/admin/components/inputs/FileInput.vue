<template>
  <input-label :for="id" class="mb-1" :value="getLabel" />
  <input
    v-bind="$attrs"
    :id="id"
    ref="input"
    :name="getName"
    class="block w-full"
    :class="{ 'form-invalid': hasError }"
    type="file"
    :multiple="multiple"
    @change="onFileChange"
  />
  <input-error :message="getError" class="mt-2" />
  <input-hint :message="hint" class="mt-2" />
  <label v-if="canDelete" class="flex items-center mt-2">
    <input type="checkbox" :checked="$props.delete" @change="onChange" />
    <span class="ml-2 text-sm text-gray-600">{{
      $t('admin.actions.delete')
    }}</span>
  </label>
</template>

<script lang="ts" setup>
  import {} from 'vue'
  import { inputProps, inputSetup } from '@admin/mixins/input'

  const props = defineProps({
    ...inputProps,
    delete: Boolean,
    multiple: Boolean,
    canDelete: Boolean,
  })

  const emit = defineEmits(['upload', 'update:delete'])

  const { getLabel, getError, hasError, id, getName } = inputSetup(props)

  const onChange = (e: Event) => {
    emit('update:delete', (e.target as HTMLInputElement).checked)
  }

  const onFileChange = (e: Event & { dataTransfer?: DataTransfer }) => {
    const files = (e.target as HTMLInputElement).files || e.dataTransfer?.files
    if (files?.length) {
      emit('upload', props.multiple ? files : files[0])
    }
  }
</script>
