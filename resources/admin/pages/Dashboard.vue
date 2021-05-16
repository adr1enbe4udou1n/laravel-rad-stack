<template>
  <app-layout>
    <teleport to="head">
      <title>{{ $title('Dashboard') }}</title>
    </teleport>

    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $t('Dashboard') }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
          Hello !
        </div>
      </div>
    </div>
  </app-layout>
</template>
