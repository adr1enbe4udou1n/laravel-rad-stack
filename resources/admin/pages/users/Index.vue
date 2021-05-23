<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $t('Users') }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
          Hello from users !
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script lang="ts">
  import { defineComponent } from 'vue'

  export default defineComponent({
    //setup() {},
  })
</script>
