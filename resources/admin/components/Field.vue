<template>
  <label class="font-medium text-sm text-gray-700">{{ $ta(source) }}</label>
  <div>
    <template v-if="value !== null && value !== undefined">
      <component
        :is="`${type}-field`"
        v-if="type"
        :value="value"
        v-bind="$attrs"
      ></component>
      <span v-else>{{ value }}</span>
    </template>
    <span v-else>-</span>
  </div>
</template>

<script lang="ts">
  import { defineComponent, inject } from 'vue'
  import EmailField from '@admin/components/fields/EmailField.vue'
  import BooleanField from '@admin/components/fields/BooleanField.vue'
  import DateField from '@admin/components/fields/DateField.vue'
  import SelectField from '@admin/components/fields/SelectField.vue'
  import get from 'lodash/get'

  export default defineComponent({
    components: {
      EmailField,
      BooleanField,
      DateField,
      SelectField,
    },
    props: {
      source: {
        type: String,
        required: true,
      },
      type: String,
    },
    setup(props) {
      const item = inject<any>('item')

      return {
        value: item ? get(item, props.source) : null,
      }
    },
  })
</script>
