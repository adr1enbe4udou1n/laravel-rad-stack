<template>
  <edit-layout resource="users" :item="user">
    <template #actions>
      <list-button />
      <show-button />
      <impersonate-button />
      <delete-button />
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
    >
      <validation-errors />

      <form @submit.prevent="submit">
        <div>
          <text-input
            v-model="form.name"
            :error="form.errors.name"
            source="name"
            type="text"
            required
          />
        </div>
        <div class="mt-4">
          <text-input
            v-model="form.email"
            :error="form.errors.email"
            source="email"
            type="email"
            required
          />
        </div>
        <div class="mt-4">
          <switch-input v-model="form.active" source="active" />
        </div>
        <div class="mt-4">
          <select-input v-model="form.role" source="role" options="roles" />
        </div>
      </form>
    </div>
  </edit-layout>
</template>

<script lang="ts">
  import { User } from '@admin/types'
  import { useForm } from '@inertiajs/inertia-vue3'
  import { defineComponent, PropType } from 'vue'
  import pick from 'lodash/pick'

  export default defineComponent({
    props: {
      user: Object as PropType<User>,
    },
    setup(props) {
      const form = useForm({
        ...pick(props.user, ['name', 'email', 'active', 'role']),
        password: '',
      })

      const submit = () => {}

      return { form, submit }
    },
  })
</script>
