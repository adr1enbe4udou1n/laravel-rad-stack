<template>
  <component
    :is="href ? 'inertia-link' : 'button'"
    class="
      inline-flex
      justify-center
      items-center
      px-4
      py-2
      border border-transparent
      rounded-md
      font-semibold
      text-xs
      uppercase
      tracking-widest
      focus:outline-none
      focus:ring
      disabled:opacity-25
      transition
    "
    :class="[
      `btn-${variant}`,
      { 'btn-outlined': outlined, 'opacity-25': loading },
    ]"
    :disabled="loading"
    :href="href"
  >
    <svg
      v-if="loading"
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      class="animate-spin -ml-1 h-4 w-4 text-white"
      :class="{
        '-ml-1 mr-2': !!$slots.default,
        '-ml-1 -mr-2': !$slots.default,
      }"
    >
      <circle
        class="opacity-25"
        cx="12"
        cy="12"
        r="10"
        stroke="currentColor"
        stroke-width="4"
      ></circle>
      <path
        class="opacity-75"
        fill="currentColor"
        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
      ></path>
    </svg>
    <component
      :is="`${icon}-icon`"
      v-else-if="icon"
      class="w-4 h-4"
      :class="{
        '-ml-1 mr-2': !!$slots.default,
        '-ml-2 -mr-2': !$slots.default,
      }"
    />
    <slot></slot>
  </component>
</template>

<script lang="ts">
  import { defineComponent } from 'vue'

  export default defineComponent({
    props: {
      loading: Boolean,
      outlined: Boolean,
      href: String,
      icon: String,
      variant: {
        type: String,
        default: 'primary',
        validator: (v: string) =>
          ['primary', 'success', 'danger', 'warning', 'info', 'dark'].includes(
            v
          ),
      },
    },
  })
</script>

<style lang="postcss" scoped>
  a,
  button {
    &:not(.btn-outlined) {
      &.btn-primary {
        @apply bg-primary-500 hover:bg-primary-700 focus:border-primary-900 focus:ring-primary-300 active:bg-primary-900 text-white;
      }
      &.btn-dark {
        @apply bg-gray-800 hover:bg-gray-700 focus:border-gray-900 focus:ring-gray-300 active:bg-gray-900 text-white;
      }
      &.btn-success {
        @apply bg-green-600 hover:bg-green-500 focus:border-green-700 focus:ring-green-200 active:bg-green-600 text-white;
      }
      &.btn-warning {
        @apply bg-yellow-400 hover:bg-yellow-500 focus:border-yellow-700 focus:ring-yellow-200 active:bg-yellow-600 text-black;
      }
      &.btn-danger {
        @apply bg-red-600 hover:bg-red-500 focus:border-red-700 focus:ring-red-200 active:bg-red-600 text-white;
      }
      &.btn-info {
        @apply bg-blue-500 hover:bg-blue-600 focus:border-blue-700 focus:ring-blue-200 active:bg-blue-600 text-white;
      }
    }

    &.btn-outlined {
      @apply bg-white shadow-sm focus:border-blue-300 focus:ring-blue-200;

      &.btn-primary {
        @apply border-primary-500 text-primary-500 hover:text-primary-500 active:text-primary-800 active:bg-primary-50;
      }

      &.btn-dark {
        @apply border-gray-300 text-gray-500 hover:text-gray-500 active:text-gray-800 active:bg-gray-50;
      }

      &.btn-success {
        @apply border-green-300 text-green-500 hover:text-green-500 active:text-green-800 active:bg-green-50;
      }

      &.btn-warning {
        @apply border-yellow-300 text-yellow-500 hover:text-yellow-500 active:text-yellow-800 active:bg-yellow-50;
      }

      &.btn-danger {
        @apply border-red-300 text-red-500 hover:text-red-500 active:text-red-800 active:bg-red-50;
      }

      &.btn-info {
        @apply border-blue-300 text-blue-500 hover:text-blue-500 active:text-blue-800 active:bg-blue-50;
      }
    }
  }
</style>
