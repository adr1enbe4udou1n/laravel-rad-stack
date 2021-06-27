<template>
  <input-label :for="id" class="mb-1" :value="getLabel" />
  <textarea
    v-if="multiline"
    v-bind="$attrs"
    :id="id"
    ref="input"
    class="block w-full"
    :class="{ 'form-invalid': !!error }"
    :value="modelValue"
    @input="onInput"
  />
  <input
    v-else
    v-bind="$attrs"
    :id="id"
    ref="input"
    class="block w-full"
    :class="{ 'form-invalid': !!error }"
    :value="modelValue"
    @input="onInput"
  />
  <input-error :message="error" class="mt-2" />
  <input-hint :message="hint" class="mt-2" />
</template>

<script lang="ts">
  import { defineComponent, Ref, ref } from 'vue'
  import { inputProps, inputSetup } from '@admin/mixins/input'

  export default defineComponent({
    props: {
      ...inputProps,
      modelValue: String,
      multiline: Boolean,
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
      const input: Ref<HTMLInputElement | null> = ref(null)
      const initial = inputSetup(props)

      const focus = () => {
        input.value?.focus()
      }

      const onInput = (e: Event) => {
        emit('update:modelValue', (e.target as HTMLInputElement).value)
      }

      return { ...initial, focus, input, onInput }
    },
  })
</script>
