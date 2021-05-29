<template>
  <show-layout resource="users" :item="user">
    <template #actions>
      <list-button />
      <edit-button />
      <impersonate-button v-if="user.can_be_impersonated" />
      <delete-button v-if="$page.props.auth.id !== user.id" />
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
        <div>
          <field source="name" />
        </div>
        <div>
          <field source="email" type="email" />
        </div>
        <div>
          <field source="active" type="boolean" />
        </div>
        <div>
          <field source="role" type="select" choices="roles" />
        </div>
        <div>
          <field source="last_login_at" type="date" />
        </div>
        <div>
          <field source="created_at" type="date" format="dd/MM/yyyy" />
        </div>
        <div>
          <field source="updated_at" type="date" format="dd/MM/yyyy" />
        </div>
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
