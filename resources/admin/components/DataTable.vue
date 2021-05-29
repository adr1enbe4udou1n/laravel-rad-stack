<template>
  <div v-if="source && !hideHeader" class="flex mb-6">
    <div v-if="!disableSearch" class="flex flex-row">
      <div class="relative">
        <input
          v-model="form.filter.q"
          type="text"
          class="w-96"
          :placeholder="$t('admin.data-table.search')"
          @input="onFilter"
        />
        <search-icon
          class="
            h-5
            w-5
            absolute
            top-1/2
            right-4
            transform
            -translate-y-1/2
            opacity-50
          "
        />
      </div>
    </div>
    <div class="ml-auto flex items-center gap-2">
      <slot name="actions"> </slot>
      <export-button v-if="!disableExport" :filter="filter" />
    </div>
  </div>
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
                {{ $ta(resource, column.field) }}
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
              {{ $ta(resource, column.field) }}
            </span>
          </th>
        </tr>
        <tr class="text-left">
          <th
            v-for="column in getColumns"
            :key="column.field"
            class="px-6 py-2 border-t"
          >
            <template v-if="column.searchable">
              <component
                :is="`${getFilterFromType(column.type || 'text')}-filter`"
                v-model="form.filter[column.field]"
                v-bind="column.props"
                @input="onFilter"
              />
            </template>
          </th>
        </tr>
      </thead>
      <tbody v-if="source">
        <data-table-row
          v-for="item in source.data"
          :key="item.id"
          class="hover:bg-gray-100 focus-within:bg-gray-100"
          :class="{ 'cursor-pointer': rowClick }"
          :columns="getColumns"
          :item="item"
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
        <tr v-if="source.data.length === 0">
          <td
            class="border-t px-6 py-4 text-center"
            :colspan="getColumns.length"
          >
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
      <spinner class="h-24 w-24 text-primary" />
    </span>
  </div>
  <div v-if="source && !hideFooter" class="flex mt-6">
    <div class="flex flex-row items-center">
      <select :value="source.per_page" class="mr-2" @input="onPerPageChange">
        <option v-for="(o, i) in perPageOptions" :key="i" :value="o">
          {{ o }}
        </option>
      </select>
      <label>{{ $t('admin.data-table.rows_per_page_text') }}</label>
    </div>
    <div v-if="source.total" class="flex flex-row items-center ml-auto">
      <span>{{
        $t('admin.data-table.page_text', {
          args: { start: source.from, end: source.to, total: source.total },
        })
      }}</span>
      <pagination
        class="ml-2"
        :current-page="source.current_page"
        :per-page="source.per_page"
        :total="source.total"
        @change="onPageChange"
      />
    </div>
  </div>
</template>

<script lang="ts">
  import {
    computed,
    defineComponent,
    getCurrentInstance,
    inject,
    PropType,
    provide,
    ref,
    watch,
  } from 'vue'
  import { Model, PaginatedData } from '@admin/types'
  import { Column } from '@admin/types/data-table'
  import route from 'ziggy-js'
  import { useForm } from '@inertiajs/inertia-vue3'
  import { Inertia } from '@inertiajs/inertia'
  import { useDebounceFn } from '@vueuse/shared'

  import TextFilter from '@admin/components/filters/TextFilter.vue'
  import SelectFilter from '@admin/components/filters/SelectFilter.vue'
  import BooleanFilter from '@admin/components/filters/BooleanFilter.vue'

  export default defineComponent({
    components: { TextFilter, SelectFilter, BooleanFilter },
    props: {
      source: Object as PropType<PaginatedData<Model>>,
      columns: Array as PropType<(string | Column)[]>,
      filter: Object as PropType<{ [key: string]: string }>,
      sort: String,
      rowClick: String,
      disableSearch: Boolean,
      disableExport: Boolean,
      hideHeader: Boolean,
      hideFooter: Boolean,
    },
    setup(props) {
      const resource = inject<string>('resource')

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

      const getFilterFromType = (type: string) => {
        return (
          {
            email: 'text',
          }[type] || type
        )
      }

      const getDefaultFilter = () => {
        return getColumns.value
          .filter((c) => c.searchable)
          .reduce(
            (acc, column) => {
              return { ...acc, [column.field]: '' }
            },
            props.disableSearch ? {} : { q: '' }
          )
      }

      const form = useForm({
        page: 1,
        perPage: 15,
        sort: props.sort,
        filter: props.filter || getDefaultFilter(),
      })

      const doQuery = () => {
        form.get(location.pathname, {
          preserveState: true,
        })
      }

      const onPageChange = (page: number) => {
        form.page = page
        doQuery()
      }

      const onPerPageChange = (e: Event) => {
        form.perPage = parseInt((e.target as HTMLInputElement).value, 10)
        doQuery()
      }

      const onRowClick = (id: number) => {
        if (props.rowClick) {
          Inertia.get(route(`admin.${resource}.${props.rowClick}`, id))
        }
      }

      const onSort = (column: Column) => {
        if (!column.sortable) return

        let prefix = ''

        if (column.field === sortBy.value && !sortDesc.value) {
          prefix = '-'
        }

        form.sort = `${prefix}${column.field}`
        doQuery()
      }

      const onFilter = useDebounceFn(() => {
        form.page = 1
        doQuery()
      })

      return {
        resource,
        sortBy,
        sortDesc,
        onFilter,
        getFilterFromType,
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
