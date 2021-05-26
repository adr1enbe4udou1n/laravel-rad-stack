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
              $tif(`crud.${resourceName}.attributes.${column.field}`) ||
              $tif(`admin.attributes.${column.field}`)
            }}
          </th>
        </tr>
      </thead>
      <tbody v-if="data">
        <tr
          v-for="item in data.data"
          :key="item.id"
          class="hover:bg-gray-100 focus-within:bg-gray-100"
          :class="{ 'cursor-pointer': rowClick }"
          @click="onRowClick(item.id)"
        >
          <td
            v-for="column in getColumns"
            :key="column.field"
            class="border-t px-6 py-4"
          >
            <div v-if="column.field === '_actions'">
              <base-button
                v-if="!disableShow"
                icon="eye"
                :href="route(`admin.${resourceName}.show`, item.id)"
                variant="success"
                @click.stop
              />
              <base-button
                v-if="!disableEdit"
                icon="pencil"
                :href="route(`admin.${resourceName}.create`)"
                class="ml-2"
                @click.stop
              />
              <base-button
                v-if="!disableDelete"
                icon="trash"
                variant="danger"
                class="ml-2"
                @click.stop
              ></base-button>
            </div>
            <div v-else class="flex items-center">
              <slot
                :name="`field:${column.field}`"
                :row="item"
                :value="item[column.field]"
              >
                <component
                  :is="`${column.type}-field`"
                  v-if="column.type"
                  :value="item[column.field]"
                  v-bind="column.props"
                />
                <span v-else>
                  {{ item[column.field] }}
                </span>
              </slot>
            </div>
          </td>
        </tr>
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
          class="h-full pl-4 pr-8 ml-2"
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

  import EmailField from '@admin/components/fields/EmailField.vue'
  import BooleanField from '@admin/components/fields/BooleanField.vue'
  import DateField from '@admin/components/fields/DateField.vue'
  import SelectField from '@admin/components/fields/SelectField.vue'
  import BaseButton from './BaseButton.vue'
  import { Inertia } from '@inertiajs/inertia'

  export default defineComponent({
    components: {
      EmailField,
      BooleanField,
      DateField,
      SelectField,
      BaseButton,
    },
    props: {
      data: Object as PropType<PaginatedData<Model>>,
      resourceName: String,
      columns: Array as PropType<(string | Column)[]>,
      filters: Array as PropType<(string | Filter)[]>,
      sortBy: String,
      sortDesc: Boolean,
      rowClick: String,
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
          .get(route(`admin.${props.resourceName}`))
      }

      const onPerPageChange = (e: Event) => {
        form
          .transform((data) => ({
            ...data,
            perPage: (e.target as HTMLInputElement).value,
          }))
          .get(route(`admin.${props.resourceName}`))
      }

      const onRowClick = (id: number) => {
        if (props.rowClick) {
          Inertia.get(
            route(`admin.${props.resourceName}.${props.rowClick}`, id)
          )
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
