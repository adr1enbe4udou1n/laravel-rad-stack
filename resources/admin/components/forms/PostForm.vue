<template>
  <form>
    <div class="flex flex-col xl:flex-row gap-6">
      <div class="xl:w-3/4 px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div>
          <text-input
            v-model="form.title"
            :error="form.errors.title"
            source="title"
            type="text"
          />
        </div>
        <div class="mt-4">
          <text-input
            v-model="form.slug"
            :error="form.errors.slug"
            source="slug"
            type="text"
            :hint="$t('Leave empty for auto generate the link.')"
          />
        </div>
        <div class="mt-4">
          <text-input
            v-model="form.summary"
            :error="form.errors.summary"
            source="summary"
            multiline
          />
        </div>
        <div class="mt-4">
          <editor-input
            v-model="form.body"
            :error="form.errors.body"
            source="body"
            :height="800"
          />
        </div>
      </div>

      <div class="xl:flex-1">
        <div
          class="
            flex flex-col
            gap-4
            px-4
            py-5
            bg-white
            sm:p-6
            shadow
            sm:rounded-md
          "
        >
          <div v-if="post">
            <field source="status" type="select" choices="post_statuses" />
          </div>
          <div>
            <rich-select-input
              v-model="form.user_id"
              :choices="post?.user ? [post?.user] : []"
              source="user"
              resource="users"
              searchable
              :min-chars="3"
            />
          </div>
          <div>
            <date-input
              v-model="form.published_at"
              source="published_at"
              :hint="
                $t(
                  'If future date, the post will be automatically posted at this date.'
                )
              "
            />
          </div>
          <div>
            <switch-input v-model="form.pin" source="pin" />
          </div>
          <div>
            <switch-input v-model="form.promote" source="promote" />
          </div>
          <div class="flex">
            <dropdown align="right" class="ml-auto">
              <template #trigger>
                <base-button
                  type="button"
                  variant="success"
                  :loading="form.processing"
                  :disabled="uploading"
                  split
                  @click="submit(true)"
                >
                  {{ $t('Publish') }}
                </base-button>
              </template>

              <template #content>
                <dropdown-link type="button" @click.prevent="submit(false)">
                  {{ $t('Save as draft') }}
                </dropdown-link>
              </template>
            </dropdown>
          </div>
        </div>
        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md mt-6">
          <div>
            <div class="flex">
              <image-field
                v-if="post?.featured_image.length"
                :value="post?.featured_image"
                class="mr-4"
              />
              <div>
                <file-input
                  v-model:delete="form.featured_image_delete"
                  source="featured_image"
                  :can-delete="!!post?.featured_image.length"
                  @upload="onUpload"
                />
              </div>
            </div>
          </div>
          <div class="mt-4">
            <reference-input
              v-model="form.category_id"
              :error="form.errors.category_id"
              source="category"
              resource="post-categories"
              allow-empty
            />
          </div>
          <div class="mt-4">
            <rich-select-input
              v-model="form.tags"
              :choices="post?.tags || []"
              source="tags"
              resource="tags"
              multiple
              taggable
              searchable
              :min-chars="3"
              option-value="name"
            />
          </div>
        </div>
        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md mt-6">
          <div>
            <text-input
              v-model="form.meta_title"
              :error="form.errors.meta_title"
              source="meta_title"
              type="text"
            />
          </div>
          <div class="mt-4">
            <text-input
              v-model="form.meta_description"
              :error="form.errors.meta_description"
              source="meta_description"
              multiline
            />
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<script lang="ts">
  import { useForm } from '@inertiajs/inertia-vue3'
  import { defineComponent, PropType, ref } from 'vue'
  import { Post } from '@admin/types'

  export default defineComponent({
    props: {
      post: Object as PropType<Post>,
      initialValues: {
        type: Object as PropType<{
          title?: string
          slug?: string
          summary?: string
          body?: string
          user_id?: number
          category_id?: number
          pin?: boolean
          promote?: boolean
          published_at?: string
          meta_title?: string
          meta_description?: string
          tags?: string[]
          featured_image_file?: File | null
          featured_image_delete?: boolean
        }>,
        default: () => {
          return {
            title: '',
            slug: '',
            summary: '',
            body: '',
            user_id: null,
            category_id: null,
            pin: false,
            promote: false,
            published_at: null,
            meta_title: null,
            meta_description: null,
            tags: [],
            featured_image_file: null,
            featured_image_delete: false,
          }
        },
      },
      method: {
        type: String,
        required: true,
      },
      url: {
        type: String,
        required: true,
      },
    },
    emits: ['submitted'],
    setup(props) {
      const uploading = ref(false)
      const form = useForm(props.initialValues)

      const onUpload = (file: File) => (form.featured_image_file = file)

      const submit = (publish: boolean) => {
        form
          .transform((data) => ({
            ...data,
            _method: props.method,
            publish,
          }))
          .post(props.url)
      }

      return { form, uploading, onUpload, submit }
    },
  })
</script>
