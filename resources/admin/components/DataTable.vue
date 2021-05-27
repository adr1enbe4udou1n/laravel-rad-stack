<template>
  <div class="bg-white rounded-md shadow overflow-x-auto relative">
    <table
      class="w-full whitespace-nowrap"
      :class="{ 'opacity-25': form.processing }"
    >
      <thead>
        <tr class="text-left font-bold">
          <th
            v-for="column in getColumns"
            :key="column.field"
            class="px-6 pt-6 pb-4"
          >
            {{
              $tif(`crud.${resource}.attributes.${column.field}`) ||
              $tif(`admin.attributes.${column.field}`)
            }}
          </th>
        </tr>
      </thead>
      <tbody v-if="data">
        <data-table-row
          v-for="item in data.data"
          :key="item.id"
          class="hover:bg-gray-100 focus-within:bg-gray-100"
          :class="{ 'cursor-pointer': rowClick }"
          :columns="getColumns"
          :item="item"
          :resource="resource"
          @click="onRowClick(item.id)"
        >
          <template
            v-for="column in getColumns"
            :key="column.field"
            #[`field:${column.field}`]="props"
          >
            <slot :name="`field:${column.field}`" v-bind="props" />
          </template>
        </data-table-row>
        <tr v-if="data.data.length === 0">
          <td class="border-t px-6 py-4" :colspan="getColumns.length">
            {{ $t('admin.data-table.empty') }}
          </td>
        </tr>
      </tbody>
    </table>
    <span
      v-if="form.processing"
      class="
        absolute
        top-1/2
        left-1/2
        transform
        -translate-x-1/2 -translate-y-1/2
      "
    >
      <spinner class="h-32 w-32 text-primary" />
    </span>
  </div>
  <div v-if="data" class="flex mt-6">
    <div class="ml-auto flex flex-row">
      <div class="flex flex-row items-center">
        <label>{{ $t('admin.data-table.rows_per_page_text') }}</label>
        <select
          :value="data.per_page"
          class="h-full pl-4 pr-8 ml-2 rounded"
          @input="onPerPageChange"
        >
          <option v-for="(o, i) in perPageOptions" :key="i" :value="o">
            {{ o }}
          </option>
        </select>
      </div>
      <div class="flex flex-row items-center ml-4">
        <span>{{
          $t('admin.data-table.page_text', {
            args: { start: data.from, end: data.to, total: data.total },
          })
        }}</span>
        <pagination
          class="ml-2"
          :current-page="data.current_page"
          :per-page="data.per_page"
          :total="data.total"
          @change="onPageChange"
        />
      </div>
    </div>
  </div>
</template>

<script lang="ts">
  import { computed, defineComponent, PropType } from 'vue'
  import { Model, PaginatedData } from '@admin/types'
  import { Column, Filter } from '@admin/types/data-table'
  import route from 'ziggy-js'
  import { useForm } from '@inertiajs/inertia-vue3'
  import { Inertia } from '@inertiajs/inertia'

  export default defineComponent({
    props: {
      data: Object as PropType<PaginatedData<Model>>,
      resource: String,
      columns: Array as PropType<(string | Column)[]>,
      filters: Array as PropType<(string | Filter)[]>,
      sortBy: String,
      sortDesc: Boolean,
      rowClick: String,
      disableSearch: Boolean,
      disableCreate: Boolean,
      disableExport: Boolean,
      hideHeader: Boolean,
      hideFooter: Boolean,
    },
    setup(props) {
      const getColumns = computed((): Column[] =>
        props.columns.map((c) => (typeof c === 'string' ? { field: c } : c))
      )

      const form = useForm({
        page: 1,
        perPage: 15,
      })

      const onPageChange = (page: number) => {
        form
          .transform((data) => ({
            ...data,
            page,
          }))
          .get(route(`admin.${props.resource}`))
      }

      const onPerPageChange = (e: Event) => {
        form
          .transform((data) => ({
            ...data,
            perPage: (e.target as HTMLInputElement).value,
          }))
          .get(route(`admin.${props.resource}`))
      }

      const onRowClick = (id: number) => {
        if (props.rowClick) {
          Inertia.get(route(`admin.${props.resource}.${props.rowClick}`, id))
        }
      }

      return {
        form,
        getColumns,
        onPageChange,
        onPerPageChange,
        onRowClick,
        perPageOptions: [5, 10, 15, 50, 100],
      }
    },
  })
</script>
