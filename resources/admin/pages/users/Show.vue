<template>
  <show-layout resource="users" :item="user">
    <template #actions>
      <list-button />
      <edit-button />
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
      <div class="flex flex-col gap-4">
        <field source="name" />
        <field source="email" type="email" />
        <field source="active" type="boolean" />
        <field source="role" type="select" choices="roles" />
        <field source="last_login_at" type="date" />
        <field source="created_at" type="date" format="dd/MM/yyyy" />
        <field source="updated_at" type="date" format="dd/MM/yyyy" />
      </div>
    </div>
  </show-layout>
</template>

<script lang="ts">
  import { User } from '@admin/types'
  import { defineComponent, PropType } from 'vue'

  export default defineComponent({
    props: {
      user: Object as PropType<User>,
    },
  })
</script>
