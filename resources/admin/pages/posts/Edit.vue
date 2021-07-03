<template>
  <edit-context v-slot="{ title }" resource="posts" :item="post">
    <app-layout>
      <template #header>
        <page-header>
          <h1>{{ title }}</h1>
          <template #actions>
            <list-button />
            <delete-button />
          </template>
        </page-header>
      </template>

      <post-form
        :method="method"
        :url="url"
        :initial-values="values"
        :post="post"
      />
    </app-layout>
  </edit-context>
</template>

<script lang="ts">
  import { defineComponent, PropType } from 'vue'
  import { Post } from '@admin/types'
  import pick from 'lodash/pick'
  import route from 'ziggy-js'

  export default defineComponent({
    props: {
      post: Object as PropType<Post>,
    },
    setup(props) {
      const values = {
        ...pick(props.post, [
          'title',
          'slug',
          'summary',
          'body',
          'user_id',
          'category_id',
          'pin',
          'promote',
          'published_at',
          'meta_title',
          'meta_description',
        ]),
        tags: props.post?.tags.map((t) => t.name) || [],
      }

      const method = 'put'
      const url = route('admin.posts.update', props.post?.id)

      return { url, method, values }
    },
  })
</script>
