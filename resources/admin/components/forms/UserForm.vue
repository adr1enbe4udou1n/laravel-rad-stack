<template>
  <form-section @submitted="submit">
    <template #form>
      <div class="col-span-6 sm:col-span-4">
        <text-input
          v-model="form.name"
          :error="form.errors.name"
          source="name"
          type="text"
        />
      </div>
      <div class="col-span-6 sm:col-span-4">
        <text-input
          v-model="form.email"
          :error="form.errors.email"
          source="email"
          type="email"
        />
      </div>
      <div class="col-span-6 sm:col-span-4">
        <text-input
          v-model="form.password"
          :error="form.errors.password"
          source="password"
          type="password"
        />
      </div>
      <div class="col-span-6 sm:col-span-4">
        <switch-input v-model="form.active" source="active" />
      </div>
      <div class="col-span-6 sm:col-span-4">
        <select-input
          v-model="form.role"
          :error="form.errors.role"
          source="role"
          choices="roles"
        />
      </div>
    </template>
    <template #actions>
      <action-message :on="form.recentlySuccessful" class="mr-3">
        {{ $t('Saved.') }}
      </action-message>

      <base-button type="submit" :loading="form.processing">
        {{ $t('Save') }}
      </base-button>
    </template>
  </form-section>
</template>

<script lang="ts">
  import { useForm } from '@inertiajs/inertia-vue3'
  import { defineComponent, PropType } from 'vue'

  export default defineComponent({
    props: {
      initialValues: {
        type: Object as PropType<{
          name: string
          email: string
          password: string
          active: string
          role: string
        }>,
        default: () => {
          return {
            name: '',
            email: '',
            password: '',
            active: true,
            role: '',
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

      const submit = () => {
        form.submit(props.method, props.url)
      }

      return { form, submit }
    },
  })
</script>
