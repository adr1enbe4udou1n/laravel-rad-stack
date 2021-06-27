<template>
  <show-context v-slot="{ title }" resource="posts">
    <app-layout>
      <template #header>
        <page-header>
          <h1>{{ title }}</h1>
          <template #actions>
            <list-button />
            <edit-button />
            <delete-button />
          </template>
        </page-header>
      </template>
    </app-layout>
  </show-context>
</template>
