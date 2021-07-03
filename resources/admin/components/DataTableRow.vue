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
            v-if="column.type && item[column.field] !== null"
            :field="column.field"
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
  import TextField from '@admin/components/fields/TextField.vue'
  import EmailField from '@admin/components/fields/EmailField.vue'
  import BooleanField from '@admin/components/fields/BooleanField.vue'
  import SwitchField from '@admin/components/fields/SwitchField.vue'
  import DateField from '@admin/components/fields/DateField.vue'
  import SelectField from '@admin/components/fields/SelectField.vue'
  import ReferenceField from '@admin/components/fields/ReferenceField.vue'
  import ImageField from '@admin/components/fields/ImageField.vue'
  import FileField from '@admin/components/fields/FileField.vue'
  import { Column } from '@admin/types/data-table'

  export default defineComponent({
    components: {
      TextField,
      EmailField,
      BooleanField,
      SwitchField,
      DateField,
      SelectField,
      ReferenceField,
      ImageField,
      FileField,
    },
    props: {
      columns: Array as PropType<Column[]>,
      item: {
        type: Object as PropType<{ [key: string]: any }>,
        required: true,
      },
    },
    setup(props) {
      provide('item', props.item)
    },
  })
</script>
