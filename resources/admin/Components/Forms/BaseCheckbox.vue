<template>
  <input
    v-model="proxyChecked"
    type="checkbox"
    :value="value"
    class="
      rounded
      border-gray-300
      text-indigo-600
      shadow-sm
      focus:border-indigo-300
      focus:ring focus:ring-indigo-200 focus:ring-opacity-50
    "
  />
</template>

<script lang="ts">
  import { computed, defineComponent } from 'vue'

  export default defineComponent({
    props: {
      checked: Boolean,
      value: Boolean,
    },
    emits: ['update:checked'],
    setup(props, { emit }) {
      const proxyChecked = computed({
        get() {
          return props.checked
        },
        set(newValue) {
          emit('update:checked', newValue)
        },
      })

      return { proxyChecked }
    },
  })
</script>
