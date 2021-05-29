<template>
  <edit-layout resource="users" :item="user">
    <template #actions>
      <list-button />
      <show-button />
      <impersonate-button v-if="user.can_be_impersonated" />
      <delete-button v-if="$page.props.auth.id !== user.id" />
    </template>

    <div class="max-w-2xl mx-auto">
      <user-form :method="method" :url="url" :initial-values="values" />
    </div>
  </edit-layout>
</template>

<script lang="ts">
  import { User } from '@admin/types'
  import { defineComponent, PropType } from 'vue'
  import pick from 'lodash/pick'
  import route from 'ziggy-js'

  export default defineComponent({
    props: {
      user: Object as PropType<User>,
    },
    setup(props) {
      const values = {
        ...pick(props.user, ['name', 'email', 'active', 'role']),
        password: '',
      }

      const method = 'put'
      const url = route('admin.users.update', props.user.id)

      return { url, method, values }
    },
  })
</script>
