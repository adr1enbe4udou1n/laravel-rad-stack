<template>
  <div
    class="md:grid md:gap-6"
    :class="{ 'md:grid-cols-3': !!$slots.title || !!$slots.description }"
  >
    <section-title>
      <template #title><slot name="title"></slot></template>
      <template #description><slot name="description"></slot></template>
    </section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
      <base-form :form="form" @submit="$emit('submit')">
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
      </base-form>
    </div>
  </div>
</template>

<script lang="ts">
  import { InertiaForm } from '@inertiajs/inertia-vue3'
  import { computed, defineComponent } from 'vue'

  export default defineComponent({
    props: {
      form: Object as InertiaForm<any>,
    },
    emits: ['submit'],
    setup(props, { slots }) {
      const hasActions = computed(() => !!slots.actions)

      return { hasActions }
    },
  })
</script>
