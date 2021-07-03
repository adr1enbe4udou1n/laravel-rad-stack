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
  import { getLocale, __ } from 'matice'
  import route from 'ziggy-js'
  import axios from 'axios'

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
          paste_data_images: true,
          images_upload_handler: async (
            blobInfo: any,
            success: (msg: string) => void,
            failure: (msg: string) => void
          ) => {
            try {
              let formData = new FormData()
              formData.append('file', blobInfo.blob(), blobInfo.filename())
              let { data } = await axios.post<{ location: string }>(
                route('admin.upload'),
                formData
              )

              success(data.location)
            } catch (e) {
              failure('HTTP Error: ' + e.status)
            }
          },
          file_picker_callback: (
            callback: (url: string, meta?: any) => void,
            value: any,
            meta: any
          ) => {
            window.tinymce.activeEditor.windowManager.openUrl({
              title: __('File Manager'),
              url: route('elfinder.tinymce5'),
              /**
               * On message will be triggered by the child window
               *
               * @param dialogApi
               * @param details
               * @see https://www.tiny.cloud/docs/ui-components/urldialog/#configurationoptions
               */
              onMessage: function (dialogApi: any, details: any) {
                if (details.mceAction === 'fileSelected') {
                  const file = details.data.file

                  // Make file info
                  const info = file.name

                  // Provide file and text for the link dialog
                  if (meta.filetype === 'file') {
                    callback(file.url, { text: info, title: info })
                  }

                  // Provide image and alt text for the image dialog
                  if (meta.filetype === 'image') {
                    callback(file.url, { alt: info })
                  }

                  // Provide alternative source and posted for the media dialog
                  if (meta.filetype === 'media') {
                    callback(file.url)
                  }

                  dialogApi.close()
                }
              },
            })
          },
        }
      })

      return { ...initial, init, value }
    },
  })
</script>
