<template>
  <span>{{ getText }}</span>
</template>

<script lang="ts">
  import { computed, defineComponent } from 'vue'
  import truncate from 'lodash/truncate'

  export default defineComponent({
    props: {
      value: {
        type: String,
        required: true,
      },
      truncate: Number,
    },
    setup(props) {
      const getText = computed(() => {
        return props.truncate
          ? truncate(props.value, {
              length: props.truncate,
            })
          : props.value
      })
      return { getText }
    },
  })
</script>
