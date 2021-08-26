<template>
  <div class="flex gap-4">
    <template v-for="(media, i) in value" :key="i">
      <a
        v-if="canPreview"
        :href="media.original_url"
        target="_blank"
        @click.stop
      >
        <img
          :src="media.preview_url"
          :width="width"
          :height="height"
          class="max-w-max"
          :alt="media.name"
        />
      </a>
      <span v-else>
        <img
          :src="media.preview_url"
          :width="width"
          :height="height"
          class="max-w-max"
          :alt="media.name"
        />
      </span>
    </template>
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
    width: {
      type: Number,
      default: 100,
    },
    height: {
      type: Number,
      default: 100,
    },
    canPreview: Boolean,
  })
</script>
