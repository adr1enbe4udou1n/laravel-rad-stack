<template>
  <div v-if="source && !hideFooter" class="flex mt-6">
    <div class="flex flex-row items-center">
      <select :value="source.per_page" class="mr-2" @input="onPerPageChange">
        <option v-for="(count, i) in perPageOptions" :key="i" :value="count">
          {{ count }}
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
  import { defineComponent, PropType } from 'vue'
  import { Model, PaginatedData } from '@admin/types'

  export default defineComponent({
    props: {
      source: Object as PropType<PaginatedData<Model>>,
      hideFooter: Boolean,
      perPageOptions: {
        type: Array as PropType<number[]>,
        default: () => [5, 10, 15, 50, 100],
      },
    },
    emits: ['change'],
    setup(props, { emit }) {
      const onPageChange = (page: number) => {
        emit('change', { page, perPage: props.source.per_page })
      }

      const onPerPageChange = (e: Event) => {
        emit('change', {
          page: 1,
          perPage: parseInt((e.target as HTMLInputElement).value, 10),
        })
      }

      return {
        onPageChange,
        onPerPageChange,
      }
    },
  })
</script>
