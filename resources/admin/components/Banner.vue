<template>
  <div>
    <div
      v-if="show && message"
      :class="{
        'bg-green-500': style == 'success',
        'bg-red-700': style == 'danger',
      }"
    >
      <div class="max-w-screen-xl mx-auto py-2 px-3 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between flex-wrap">
          <div class="w-0 flex-1 flex items-center min-w-0">
            <span
              class="flex p-2 rounded-lg"
              :class="{
                'bg-green-600': style == 'success',
                'bg-red-600': style == 'danger',
              }"
            >
              <component :is="`${icon}-icon`" class="w-5 h-5 text-white" />
            </span>

            <p class="ml-3 font-medium text-sm text-white truncate">
              {{ message }}
            </p>
          </div>

          <div class="flex-shrink-0 sm:ml-3">
            <button
              type="button"
              class="
                -mr-1
                flex
                p-2
                rounded-md
                focus:outline-none
                sm:-mr-2
                transition
              "
              :class="{
                'hover:bg-green-600 focus:bg-green-600': style == 'success',
                'hover:bg-red-600 focus:bg-red-600': style == 'danger',
              }"
              aria-label="Dismiss"
              @click.prevent="show = false"
            >
              <x-icon class="w-5 h-5 text-white" />
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
  import { computed, defineComponent, ref } from 'vue'
  import { usePage } from '@inertiajs/inertia-vue3'

  export default defineComponent({
    setup() {
      const show = ref(true)

      const style = computed(
        () => usePage().props.value.flash?.bannerStyle || 'success'
      )

      const icon = computed(() => {
        const v: 'success' | 'danger' = style.value

        return {
          success: 'check-circle',
          danger: 'exclamation',
        }[v]
      })

      const message = computed(() => usePage().props.value.flash?.banner || '')

      return { show, style, message, icon }
    },
  })
</script>
