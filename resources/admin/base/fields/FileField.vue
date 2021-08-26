<template>
  <div class="flex flex-col">
    <a
      v-for="(media, i) in value"
      :key="i"
      class="text-primary-500 underline"
      :href="media.original_url"
      target="_blank"
      @click.stop
    >
      {{ media.name }}
    </a>
  </div>
</template>

<script lang="ts" setup>
  import { PropType } from 'vue'

  defineProps({
    value: {
      type: [String, Object] as
        | PropType<{ preview_url: string; original_url: string }[]>
        | PropType<{
            [uuid: string]: { preview_url: string; original_url: string }
          }>,
      required: true,
    },
  })
</script>
