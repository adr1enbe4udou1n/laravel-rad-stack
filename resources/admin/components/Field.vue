<template>
  <div>
    <label class="font-bold">{{ $ta(resource, source) }}</label>
    <div>
      <template v-if="item[source]">
        <component
          :is="`${type}-field`"
          v-if="type"
          :value="item[source]"
          v-bind="$attrs"
        ></component>
        <span v-else>{{ item[source] }}</span>
      </template>
      <span v-else>-</span>
    </div>
  </div>
</template>

<script lang="ts">
  import { Model } from '@admin/types'
  import { defineComponent, inject } from 'vue'
  import EmailField from '@admin/components/fields/EmailField.vue'
  import BooleanField from '@admin/components/fields/BooleanField.vue'
  import DateField from '@admin/components/fields/DateField.vue'
  import SelectField from '@admin/components/fields/SelectField.vue'

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
    setup() {
      const resource = inject<string>('resource')
      const item = inject<Model>('item')

      return {
        resource,
        item,
      }
    },
  })
</script>
