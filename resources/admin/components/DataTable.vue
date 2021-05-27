<template>
  <div class="bg-white rounded-md shadow overflow-x-auto relative">
    <table
      class="w-full whitespace-nowrap"
      :class="{ 'opacity-25': form.processing }"
    >
      <thead>
        <tr class="text-left">
          <th
            v-for="column in getColumns"
            :key="column.field"
            class="px-6 pt-6 pb-4 border-primary-500"
            :style="column.width ? `width: ${column.width}px` : ''"
            :class="{
              'text-right': column.numeric,
              'text-center': column.centered,
              'border-b': column.field === sortBy,
              'hover:border-b cursor-pointer': column.sortable,
            }"
            @click="onSort(column)"
          >
            <div
              v-if="column.sortable"
              type="button"
              class="inline-flex items-center font-bold"
            >
              <span :class="{ 'order-2': column.numeric }">
                {{
                  $tif(`crud.${resource}.attributes.${column.field}`) ||
                  $tif(`admin.attributes.${column.field}`)
                }}
              </span>
              <component
                :is="`${sortDesc ? 'arrow-down' : 'arrow-up'}-icon`"
                v-if="column.field === sortBy"
                class="h-4 w-4"
                :class="{
                  'order-1 mr-2': column.numeric,
                  'ml-2': !column.numeric,
                }"
              />
            </div>
            <span v-else>
              {{
                $tif(`crud.${resource}.attributes.${column.field}`) ||
                $tif(`admin.attributes.${column.field}`)
              }}
            </span>
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
  import { computed, defineComponent, PropType, ref, watch } from 'vue'
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
      sort: String,
      rowClick: String,
      disableSearch: Boolean,
      disableCreate: Boolean,
      disableExport: Boolean,
      hideHeader: Boolean,
      hideFooter: Boolean,
    },
    setup(props) {
      const sortBy = ref('id')
      const sortDesc = ref(false)

      watch(
        () => props.sort,
        (val) => {
          if (!val) return

          if (val.startsWith('-')) {
            sortBy.value = val.substring(1)
            sortDesc.value = true
            return
          }
          sortBy.value = val
          sortDesc.value = false
        },
        { immediate: true }
      )

      const getColumns = computed((): Column[] =>
        props.columns.map((c) => (typeof c === 'string' ? { field: c } : c))
      )

      const form = useForm({
        page: 1,
        perPage: 15,
        sort: props.sort,
      })

      const doQuery = (query: any) => {
        form
          .transform((data) => ({
            ...data,
            ...query,
          }))
          .get(route(`admin.${props.resource}`))
      }

      const onPageChange = (page: number) => {
        doQuery({ page })
      }

      const onPerPageChange = (e: Event) => {
        doQuery({ perPage: (e.target as HTMLInputElement).value })
      }

      const onRowClick = (id: number) => {
        if (props.rowClick) {
          Inertia.get(route(`admin.${props.resource}.${props.rowClick}`, id))
        }
      }

      const onSort = (column: Column) => {
        if (!column.sortable) return

        let prefix = ''

        if (column.field === sortBy.value && !sortDesc.value) {
          prefix = '-'
        }

        doQuery({ sort: `${prefix}${column.field}` })
      }

      return {
        sortBy,
        sortDesc,
        form,
        getColumns,
        onPageChange,
        onPerPageChange,
        onRowClick,
        onSort,
        perPageOptions: [5, 10, 15, 50, 100],
      }
    },
  })
</script>
