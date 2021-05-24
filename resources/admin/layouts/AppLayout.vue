<template>
  <div>
    <div class="min-h-screen bg-gray-100">
      <navbar />

      <!-- Page Heading -->
      <header v-if="$slots.header" class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <slot name="header"></slot>
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <flash-messages />
        <slot></slot>
      </main>
    </div>
  </div>
</template>
