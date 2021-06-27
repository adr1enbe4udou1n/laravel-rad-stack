<template>
  <input-label :for="id" class="mb-1" :value="getLabel" />
  <editor :id="id" v-model="value" api-key="no-api-key" :init="init"></editor>
  <input-error :message="error" class="mt-2" />
  <input-hint :message="hint" class="mt-2" />
</template>

<script lang="ts">
  import Editor from '@tinymce/tinymce-vue'

  import { computed, defineComponent } from 'vue'
  import { inputProps, inputSetup } from '@admin/mixins/input'
  import { getLocale } from 'matice'

  export default defineComponent({
    components: { Editor },
    props: {
      ...inputProps,
      modelValue: String,
      height: {
        type: Number,
        default: 500,
      },
      menubar: Boolean,
      statusbar: Boolean,
      inline: Boolean,
      plugins: Array,
      toolbar: String,
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
      const initial = inputSetup(props)

      const value = computed({
        get: () => props.modelValue,
        set: (val) => emit('update:modelValue', val),
      })

      const init = computed(() => {
        return {
          language: getLocale() === 'fr' ? 'fr_FR' : null,
          menubar: props.menubar,
          statusbar: props.statusbar,
          inline: props.inline,
          plugins: props.plugins || [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media paste code help wordcount table',
          ],
          toolbar:
            props.toolbar ||
            'undo redo | formatselect | bold italic | \
            bullist numlist | image media table | help',
          height: props.height,
        }
      })

      return { ...initial, init, value }
    },
  })
</script>
