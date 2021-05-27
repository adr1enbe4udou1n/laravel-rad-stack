<template>
  <app-layout>
    <template #header>
      <h1>{{ title }}</h1>
    </template>

    <data-table
      :data="users"
      sort-by="id"
      :sort-desc="false"
      :columns="columns"
      resource="users"
      row-click="edit"
    >
      <template #field:row-action>
        <div class="flex gap-2">
          <show-button />
          <edit-button />
          <impersonate-button />
          <delete-button />
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
        },
        {
          field: 'created_at',
          type: 'date',
        },
        {
          field: 'updated_at',
          type: 'date',
        },
        'row-action',
      ]

      return { title, columns }
    },
  })
</script>
