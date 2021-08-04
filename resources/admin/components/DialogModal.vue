<template>
  <modal
    :show="show"
    :max-width="maxWidth"
    :closeable="closeable"
    @close="$emit('close')"
  >
    <base-form :form="form" @submit="$emit('submit')">
      <div class="px-6 py-4">
        <div class="text-lg">
          <slot name="title"></slot>
        </div>

        <div class="mt-4">
          <slot name="content"></slot>
        </div>
      </div>

      <div class="px-6 py-4 bg-gray-100 text-right">
        <slot name="footer"></slot>
      </div>
    </base-form>
  </modal>
</template>

<script lang="ts">
  import { InertiaForm } from '@inertiajs/inertia-vue3'
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      form: Object as InertiaForm<any>,
      show: {
        type: Boolean,
        default: false,
      },
      maxWidth: {
        type: String,
        default: '2xl',
      },
      closeable: {
        type: Boolean,
        default: true,
      },
    },
    emits: ['close', 'submit'],
  })
</script>
