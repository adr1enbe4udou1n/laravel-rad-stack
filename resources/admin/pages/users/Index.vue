<template>
  <app-layout>
    <template #header>
      <h1>{{ title }}</h1>
    </template>

    <data-table
      :data="users"
      :columns="columns"
      :sort="sort"
      resource="users"
      row-click="edit"
    >
      <template #field:row-action="{ row }">
        <div class="flex gap-2 ml-auto">
          <show-button />
          <edit-button />
          <impersonate-button v-if="row.can_be_impersonated" />
          <delete-button v-if="$page.props.user.id !== row.id" />
        </div>
      </template>
    </data-table>
  </app-layout>
</template>

<script lang="ts">
  import { useTitle } from '@admin/features/helpers'
  import { defineComponent, PropType } from 'vue'
  import { PaginatedData, User } from '@admin/types'
  import { Column } from '@admin/types/data-table'

  export default defineComponent({
    props: {
      sort: String,
      users: Object as PropType<PaginatedData<User>>,
    },
    setup() {
      const title = useTitle('crud.users.titles.index')

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
          centered: true,
        },
        {
          field: 'role',
          type: 'select',
          props: { options: 'roles' },
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

      return { title, columns }
    },
  })
</script>
