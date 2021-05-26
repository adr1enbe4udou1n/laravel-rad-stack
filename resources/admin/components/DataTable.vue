<template>
  <div class="bg-white rounded-md shadow overflow-x-auto">
    <table class="w-full whitespace-nowrap">
      <thead>
        <tr class="text-left font-bold">
          <th
            v-for="column in getColumns"
            :key="column.field"
            class="px-6 pt-6 pb-4"
          >
            {{
              $tif(`crud.${resourceName}.attributes.${column.field}`) ||
              $tif(`admin.attributes.${column.field}`)
            }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="item in data"
          :key="item.id"
          class="hover:bg-gray-100 focus-within:bg-gray-100"
        >
          <td
            v-for="column in getColumns"
            :key="column.field"
            class="border-t px-6 py-4"
          >
            <div v-if="column.field === '_actions'">Action !</div>
            <span v-else>{{ item[column.field] }}</span>
          </td>
        </tr>
        <tr v-if="data.length === 0">
          <td class="border-t px-6 py-4" :colspan="getColumns.length">
            {{ $t('admin.data-table.empty') }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script lang="ts">
  import { computed, defineComponent, PropType } from 'vue'
  import { Model } from '@admin/types'
  import { Column, Filter } from '@admin/types/data-table'

  export default defineComponent({
    props: {
      data: Array as PropType<Model[]>,
      perPage: Number,
      currentPage: Number,
      total: Number,
      resourceName: String,
      columns: Array as PropType<(string | Column)[]>,
      filters: Array as PropType<(string | Filter)[]>,
      sortBy: String,
      sortDesc: Boolean,
      disableSearch: Boolean,
      disableCreate: Boolean,
      disableShow: Boolean,
      disableEdit: Boolean,
      disableDelete: Boolean,
      disableExport: Boolean,
      hideHeader: Boolean,
      hideFooter: Boolean,
      hideActionsColumn: Boolean,
    },
    setup(props) {
      const getColumns = computed((): Column[] => {
        let columns = props.columns.map((c) =>
          typeof c === 'string' ? { field: c } : c
        )

        if (!props.hideActionsColumn) {
          columns.push({ field: '_actions' })
        }

        return columns
      })

      return { getColumns }
    },
  })
</script>
