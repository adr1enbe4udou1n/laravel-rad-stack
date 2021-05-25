<template>
  <app-layout>
    <template #header>
      <h1>{{ $t('Profile') }}</h1>
    </template>

    <div class="max-w-7xl mx-auto">
      <update-profile-information-form :user="$page.props.user" />

      <section-border />

      <update-password-form class="mt-10 sm:mt-0" />

      <section-border />

      <delete-user-form class="mt-10 sm:mt-0" />
    </div>
  </app-layout>
</template>

<script lang="ts">
  import { useTitle } from '@admin/features/helpers'
  import { defineComponent } from 'vue'

  export default defineComponent({
    setup() {
      useTitle('Profile')
    },
  })
</script>
