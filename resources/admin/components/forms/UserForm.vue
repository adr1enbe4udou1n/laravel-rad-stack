<template>
  <form @submit.prevent="submit">
    <div>
      <text-input
        v-model="form.name"
        :error="form.errors.name"
        source="name"
        type="text"
      />
    </div>
    <div class="mt-4">
      <text-input
        v-model="form.email"
        :error="form.errors.email"
        source="email"
        type="email"
      />
    </div>
    <div class="mt-4">
      <text-input
        v-model="form.password"
        :error="form.errors.password"
        source="password"
        type="password"
      />
    </div>
    <div class="mt-4">
      <switch-input v-model="form.active" source="active" />
    </div>
    <div class="mt-4">
      <radio-group-input
        v-model="form.role"
        :error="form.errors.role"
        source="role"
        choices="roles"
        stacked
      />
    </div>
    <div class="flex justify-end mt-4">
      <base-button type="submit" :loading="form.processing">
        {{ $t('Save') }}
      </base-button>
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
