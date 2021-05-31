<template>
  <edit-context v-slot="{ title }" resource="users" :item="user">
    <app-aside :title="title">
      <user-form :method="method" :url="url" :initial-values="values">
        <template #actions>
          <impersonate-button hide-label />
          <delete-button hide-label />
        </template>
      </user-form>
    </app-aside>
  </edit-context>
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
      const url = route('admin.users.update', props.user?.id)

      return { url, method, values }
    },
  })
</script>
