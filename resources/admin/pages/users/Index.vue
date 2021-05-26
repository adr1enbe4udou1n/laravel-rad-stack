<template>
  <app-layout>
    <template #header>
      <h1>{{ title }}</h1>
    </template>

    <data-table
      :data="users.data"
      :per-page="users.per_page"
      :current-page="users.current_page"
      :total="users.total"
      sort-by="id"
      :sort-desc="false"
      :columns="columns"
      resource-name="users"
    ></data-table>
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
        },
        'active',
        'role',
        'last_login_at',
        'created_at',
        'updated_at',
      ]

      return { title, columns }
    },
  })
</script>
