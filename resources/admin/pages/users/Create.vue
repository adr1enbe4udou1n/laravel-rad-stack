<template>
  <create-layout resource="users">
    <template #actions>
      <list-button />
    </template>
    <div
      class="
        max-w-md
        mx-auto
        px-6
        py-4
        bg-white
        shadow-md
        overflow-hidden
        rounded-lg
      "
    ></div>
  </create-layout>
</template>

<script lang="ts">
  import { useForm } from '@inertiajs/inertia-vue3'
  import { defineComponent } from 'vue'

  export default defineComponent({
    setup() {
      const form = useForm({
        name: '',
        email: '',
        password: '',
        active: '',
        role: '',
      })

      const submit = () => {}

      return { form, submit }
    },
  })
</script>
