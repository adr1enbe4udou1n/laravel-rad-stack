<template>
  <modal
    :show="show"
    :max-width="maxWidth"
    :closeable="closeable"
    @close="$emit('close')"
  >
    <form @submit.prevent="$emit('submit')">
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
    </form>
  </modal>
</template>

<script lang="ts">
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
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
