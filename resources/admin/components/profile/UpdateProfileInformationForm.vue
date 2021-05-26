<template>
  <form-section @submitted="submit">
    <template #title> {{ $t('Profile Information') }} </template>

    <template #description>
      {{ $t("Update your account's profile information and email address.") }}
    </template>

    <template #form>
      <!-- Name -->
      <div class="col-span-6 sm:col-span-4">
        <base-input
          v-model="form.name"
          :error="form.errors.name"
          :label="$t('Name')"
          type="text"
          required
          autocomplete="name"
        />
      </div>

      <!-- Email -->
      <div class="col-span-6 sm:col-span-4">
        <base-input
          v-model="form.email"
          :error="form.errors.email"
          :label="$t('Email')"
          type="text"
          required
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
  import route from 'ziggy-js'
  import { useForm } from '@inertiajs/inertia-vue3'
  import { defineComponent, PropType } from 'vue'
  import { Profile } from '@admin/types'

  export default defineComponent({
    props: {
      user: Object as PropType<Profile>,
    },
    setup(props) {
      const form = useForm({
        name: props.user.name,
        email: props.user.email,
      })

      const submit = () => {
        form.put(route('user-profile-information.update'), {
          errorBag: 'updateProfileInformation',
          preserveScroll: true,
        })
      }

      return { form, submit }
    },
  })
</script>
