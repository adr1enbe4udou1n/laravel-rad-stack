<template>
  <list-context v-slot="{ title }" resource="users">
    <app-layout>
      <template #header>
        <page-header>
          <h1>{{ title }}</h1>
          <template #actions>
            <create-button :only="['route']" />
          </template>
        </page-header>
      </template>

      <data-table
        :source="users"
        :columns="columns"
        :sort="sort"
        :filter="filter"
        row-click="edit"
      >
        <template #field:row-action="{ row }">
          <div class="flex gap-2 ml-auto">
            <show-button hide-label :only="['route', 'user']" />
            <edit-button hide-label :only="['route', 'user']" />
            <impersonate-button v-if="row.can_be_impersonated" hide-label />
            <delete-button v-if="$page.props.auth.id !== row.id" hide-label />
          </div>
        </template>
      </data-table>

      <template v-if="route !== 'list'" #aside>
        <create-user v-if="route === 'create'" />
        <show-user v-if="route === 'show'" :user="user" />
        <edit-user v-if="route === 'edit'" :user="user" />
      </template>
    </app-layout>
  </list-context>
</template>

<script lang="ts">
  import { defineComponent, PropType } from 'vue'
  import { PaginatedData, User } from '@admin/types'
  import { Column } from '@admin/types/data-table'

  import CreateUser from '@admin/components/users/CreateUser.vue'
  import ShowUser from '@admin/components/users/ShowUser.vue'
  import EditUser from '@admin/components/users/EditUser.vue'

  export default defineComponent({
    components: { CreateUser, ShowUser, EditUser },
    props: {
      route: String,
      users: Object as PropType<PaginatedData<User>>,
      user: Object as PropType<User>,
      sort: String,
      filter: Object,
    },
    setup() {
      const columns: (string | Column)[] = [
        {
          field: 'id',
          width: 40,
          numeric: true,
          sortable: true,
        },
        {
          field: 'name',
          sortable: true,
          searchable: true,
        },
        {
          field: 'email',
          searchable: true,
          type: 'email',
        },
        {
          field: 'active',
          type: 'boolean',
          searchable: true,
        },
        {
          field: 'role',
          type: 'select',
          props: { choices: 'roles' },
          searchable: true,
        },
        {
          field: 'last_login_at',
          type: 'date',
          props: { format: 'dd/MM/yyyy HH:mm:ss' },
          sortable: true,
          centered: true,
        },
        {
          field: 'created_at',
          type: 'date',
          sortable: true,
          centered: true,
        },
        {
          field: 'updated_at',
          type: 'date',
          sortable: true,
          centered: true,
        },
        'row-action',
      ]

      return { columns }
    },
  })
</script>
