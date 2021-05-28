<template>
  <list-layout resource="users">
    <template #actions>
      <create-button />
    </template>

    <data-table
      :source="users"
      :columns="columns"
      :sort="sort"
      :filter="filter"
      resource="users"
      row-click="edit"
    >
      <template #field:row-action="{ row }">
        <div class="flex gap-2 ml-auto">
          <show-button hide-label />
          <edit-button hide-label />
          <impersonate-button v-if="row.can_be_impersonated" hide-label />
          <delete-button v-if="$page.props.user.id !== row.id" hide-label />
        </div>
      </template>
    </data-table>
  </list-layout>
</template>

<script lang="ts">
  import { defineComponent, PropType } from 'vue'
  import { PaginatedData, User } from '@admin/types'
  import { Column } from '@admin/types/data-table'

  export default defineComponent({
    props: {
      users: Object as PropType<PaginatedData<User>>,
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

      return { columns }
    },
  })
</script>
