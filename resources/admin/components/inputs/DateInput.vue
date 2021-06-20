<template>
  <input-label :for="id" class="mb-1" :value="getLabel" />
  <div class="relative">
    <input
      v-bind="$attrs"
      :id="id"
      ref="fpInput"
      type="text"
      class="block w-full"
      :class="{ 'form-invalid': !!error }"
      :value="modelValue"
      @input="onInput"
    />
    <button
      v-if="modelValue"
      type="button"
      class="absolute top-1/2 right-3 transform -translate-y-1/2 opacity-50"
      @click="$emit('update:modelValue', '')"
    >
      <x-icon class="h-5 w-5" />
    </button>
  </div>
  <input-error :message="error" class="mt-2" />
</template>

<script lang="ts">
  import {
    defineComponent,
    onBeforeUnmount,
    onMounted,
    PropType,
    Ref,
    ref,
  } from 'vue'
  import { inputProps, inputSetup } from '@admin/mixins/input'
  import 'flatpickr/dist/flatpickr.min.css'
  import flatpickr from 'flatpickr'
  import { Instance as FlatpickrInstance } from 'flatpickr/dist/types/instance'
  import { Options as FlatpickrOptions } from 'flatpickr/dist/types/options'
  import { French } from 'flatpickr/dist/l10n/fr.js'
  import { getLocale } from 'matice'

  export default defineComponent({
    props: {
      ...inputProps,
      modelValue: [String, Number],
      options: Object as PropType<FlatpickrOptions>,
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
      const fp: Ref<FlatpickrInstance | null> = ref(null)
      const fpInput: Ref<HTMLInputElement | null> = ref(null)

      const initial = inputSetup(props)

      const onInput = (e: Event) => {
        emit('update:modelValue', (e.target as HTMLInputElement).value)
      }

      onMounted(() => {
        if (fp.value) return

        let config: FlatpickrOptions = props.options || {
          enableTime: true,
          dateFormat: 'Y-m-d H:i',
        }

        if (getLocale() === 'fr') {
          config.locale = French
        }

        fp.value = flatpickr(fpInput.value as Node, config)
      })
      onBeforeUnmount(() => {
        if (fp.value) {
          fp.value?.destroy()
          fp.value = null
        }
      })

      return { ...initial, fp, fpInput, onInput }
    },
  })
</script>
