<template>
  <input-label :for="id" class="mb-1" :value="getLabel" />
  <input
    v-bind="$attrs"
    :id="id"
    ref="input"
    class="block w-full"
    :class="{ 'form-invalid': !!error }"
    type="file"
    :multiple="multiple"
    @change="onFileChange"
  />
  <input-error :message="error" class="mt-2" />
  <input-hint :message="hint" class="mt-2" />
  <label v-if="canDelete" class="flex items-center mt-2">
    <input type="checkbox" :checked="$props.delete" @change="onChange" />
    <span class="ml-2 text-sm text-gray-600">{{
      $t('admin.actions.delete')
    }}</span>
  </label>
</template>

<script lang="ts">
  import { defineComponent } from 'vue'
  import { inputProps, inputSetup } from '@admin/mixins/input'

  export default defineComponent({
    props: {
      ...inputProps,
      delete: Boolean,
      multiple: Boolean,
      canDelete: Boolean,
    },
    emits: ['upload', 'update:delete'],
    setup(props, { emit }) {
      const initial = inputSetup(props)

      const onChange = (e: Event) => {
        emit('update:delete', (e.target as HTMLInputElement).checked)
      }

      const onFileChange = (e: Event & { dataTransfer?: DataTransfer }) => {
        const files =
          (e.target as HTMLInputElement).files || e.dataTransfer?.files
        if (files?.length) {
          emit('upload', props.multiple ? files : files[0])
        }
      }

      return { ...initial, onChange, onFileChange }
    },
  })
</script>
