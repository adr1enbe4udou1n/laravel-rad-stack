<template>
  <app-layout>
    <teleport to="head">
      <title>{{ $title('Profile') }}</title>
    </teleport>

    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $t('Profile') }}
      </h2>
    </template>

    <div>
      <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <update-profile-information-form :user="$page.props.user" />

        <section-border />

        <update-password-form class="mt-10 sm:mt-0" />

        <section-border />

        <delete-user-form class="mt-10 sm:mt-0" />
        <delete-user-form-test class="mt-10 sm:mt-0" />
        <delete-user-form-test-2 class="mt-10 sm:mt-0" />
      </div>
    </div>
  </app-layout>
</template>
