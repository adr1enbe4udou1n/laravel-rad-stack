<template>
  <label class="flex items-center">
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
    <span class="ml-2 text-sm text-gray-600">{{ label }}</span>
  </label>
</template>

<script lang="ts">
  import { useUniqueId } from '@admin/features/unique-id'
  import { computed, defineComponent } from 'vue'

  export default defineComponent({
    props: {
      label: String,
      checked: Boolean,
      value: Boolean,
    },
    emits: ['update:checked'],
    setup(props, { emit }) {
      const id = useUniqueId()

      const proxyChecked = computed({
        get() {
          return props.checked
        },
        set(newValue) {
          emit('update:checked', newValue)
        },
      })

      return { id, proxyChecked }
    },
  })
</script>
