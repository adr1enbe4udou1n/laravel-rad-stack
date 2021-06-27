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
            :hint="$t('Leave empty for auto generate the link')"
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
          />
        </div>
      </div>

      <div class="xl:flex-1">
        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
          <div>
            <field source="status" type="select" choices="post_statuses" />
          </div>
          <div class="mt-4">
            <reference-input
              v-model="form.category_id"
              :error="form.errors.category_id"
              source="category"
              resource="post-categories"
            />
          </div>
          <div class="mt-4">
            <switch-input v-model="form.pin" source="pin" />
          </div>
          <div class="mt-4">
            <switch-input v-model="form.promote" source="promote" />
          </div>
          <div class="mt-4">
            <date-input v-model="form.published_at" source="published_at" />
          </div>
          <div class="mt-4 flex">
            <dropdown align="right" class="ml-auto">
              <template #trigger>
                <base-button
                  type="button"
                  variant="success"
                  :loading="form.processing"
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
  import { defineComponent, PropType } from 'vue'

  export default defineComponent({
    props: {
      initialValues: {
        type: Object as PropType<{
          title?: string
          slug?: string
          summary?: string
          body?: string
          category_id?: number
          pin?: boolean
          promote?: boolean
          published_at?: string
          meta_title?: string
          meta_description?: string
        }>,
        default: () => {
          return {
            title: '',
            slug: '',
            summary: '',
            body: '',
            category_id: null,
            pin: false,
            promote: false,
            published_at: null,
            meta_title: null,
            meta_description: null,
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
      const form = useForm(props.initialValues)

      const submit = (publish: boolean) => {
        form
          .transform((data) => ({
            ...data,
            publish,
          }))
          .submit(props.method, props.url)
      }

      return { form, submit }
    },
  })
</script>
