<template>
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1 flex justify-between">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium text-gray-900">
          <slot name="title"></slot>
        </h3>

        <p class="mt-1 text-sm text-gray-600">
          <slot name="description"></slot>
        </p>
      </div>

      <div class="px-4 sm:px-0">
        <slot name="aside"></slot>
      </div>
    </div>

    <div class="mt-5 md:mt-0 md:col-span-2">
      <form @submit.prevent="$emit('submitted')">
        <div
          class="px-4 py-5 bg-white sm:p-6 shadow"
          :class="
            hasActions ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md'
          "
        >
          <div class="grid grid-cols-6 gap-6">
            <slot name="form"></slot>
          </div>
        </div>

        <div
          v-if="hasActions"
          class="
            flex
            items-center
            justify-end
            px-4
            py-3
            bg-gray-50
            text-right
            sm:px-6
            shadow
            sm:rounded-bl-md sm:rounded-br-md
          "
        >
          <slot name="actions"></slot>
        </div>
      </form>
    </div>
  </div>
</template>

<script lang="ts">
  import { computed, defineComponent } from 'vue'

  export default defineComponent({
    emits: ['submitted'],
    setup(props, { slots }) {
      const hasActions = computed(() => !!slots.actions)

      return { hasActions }
    },
  })
</script>
