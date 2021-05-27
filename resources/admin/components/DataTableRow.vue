<template>
  <tr>
    <td
      v-for="column in columns"
      :key="column.field"
      class="border-t px-6 py-4"
    >
      <div
        class="flex items-center"
        :class="{
          'justify-end': column.numeric,
          'justify-center': column.centered,
        }"
      >
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
</template>

<script lang="ts">
  import { defineComponent, PropType, provide } from 'vue'
  import EmailField from '@admin/components/fields/EmailField.vue'
  import BooleanField from '@admin/components/fields/BooleanField.vue'
  import DateField from '@admin/components/fields/DateField.vue'
  import SelectField from '@admin/components/fields/SelectField.vue'
  import BaseButton from './BaseButton.vue'
  import { Model } from '@admin/types'
  import { Column } from '@admin/types/data-table'

  export default defineComponent({
    components: {
      EmailField,
      BooleanField,
      DateField,
      SelectField,
      BaseButton,
    },
    props: {
      columns: Array as PropType<Column[]>,
      item: Object as PropType<Model>,
      resource: String,
    },
    setup(props) {
      provide('resource', props.resource)
      provide('item', props.item)
    },
  })
</script>
