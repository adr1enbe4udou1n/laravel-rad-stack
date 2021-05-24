<template>
  <nav class="sm:border-b sm:border-gray-100">
    <!-- Primary Navigation Menu -->
    <div
      class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-primary-500 sm:bg-white"
    >
      <div class="flex justify-between h-16">
        <div class="flex">
          <!-- Logo -->
          <div class="flex-shrink-0 flex items-center sm:hidden">
            <inertia-link :href="route('admin.dashboard')">
              <app-logo class="block h-9 w-auto fill-white" />
            </inertia-link>
          </div>

          <!-- Navigation Links -->
          <div class="hidden space-x-8 sm:-my-px sm:flex">
            <nav-link
              v-for="(link, i) in headerNav"
              :key="i"
              :href="link.href"
              :active="link.active()"
              :icon="link.icon"
            >
              {{ link.text }}
            </nav-link>
          </div>
        </div>

        <div class="hidden sm:flex sm:items-center sm:ml-6">
          <!-- Settings Dropdown -->
          <div class="ml-3 relative">
            <dropdown align="right" width="48">
              <template #trigger>
                <span class="inline-flex rounded-md">
                  <button
                    type="button"
                    class="
                      inline-flex
                      items-center
                      px-3
                      py-2
                      border border-transparent
                      text-sm
                      leading-4
                      font-medium
                      rounded-md
                      text-gray-500
                      bg-white
                      hover:text-gray-700
                      focus:outline-none
                      transition
                    "
                  >
                    {{ $page.props.user.name }}

                    <chevron-down-icon class="h-4 w-4 ml-2" />
                  </button>
                </span>
              </template>

              <template #content>
                <!-- Account Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                  {{ $t('Manage Account') }}
                </div>

                <dropdown-link :href="route('admin.profile.show')" icon="user">
                  {{ $t('Profile') }}
                </dropdown-link>

                <div class="border-t border-gray-100"></div>

                <!-- Authentication -->
                <dropdown-link icon="logout" @click="logout">
                  {{ $t('Log Out') }}
                </dropdown-link>
              </template>
            </dropdown>
          </div>
        </div>

        <!-- Hamburger -->
        <div class="-mr-2 flex items-center sm:hidden">
          <button
            class="
              inline-flex
              items-center
              justify-center
              p-2
              rounded-md
              text-white
              sm:text-gray-400
              hover:text-gray-500
              hover:bg-gray-100
              focus:outline-none
              focus:bg-gray-100
              focus:text-gray-500
              transition
            "
            @click="showingNavigationDropdown = !showingNavigationDropdown"
          >
            <x-icon v-if="showingNavigationDropdown" class="h-6 w-6" />
            <menu-icon v-else class="h-6 w-6" />
          </button>
        </div>
      </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div
      :class="{
        block: showingNavigationDropdown,
        hidden: !showingNavigationDropdown,
      }"
      class="sm:hidden"
    >
      <div class="pt-2 pb-3 space-y-1">
        <responsive-nav-link
          v-for="(link, i) in mainNav"
          :key="i"
          :href="link.href"
          :active="link.active()"
        >
          {{ link.text }}
        </responsive-nav-link>
      </div>

      <!-- Responsive Settings Options -->
      <div class="pt-4 pb-1 border-t border-gray-200">
        <div class="flex items-center px-4">
          <div>
            <div class="font-medium text-base text-gray-800">
              {{ $page.props.user.name }}
            </div>
            <div class="font-medium text-sm text-gray-500">
              {{ $page.props.user.email }}
            </div>
          </div>
        </div>

        <div class="mt-3 space-y-1">
          <responsive-nav-link
            :href="route('admin.profile.show')"
            :active="route().current('admin.profile.show')"
          >
            {{ $t('Profile') }}
          </responsive-nav-link>

          <!-- Authentication -->
          <responsive-nav-link @click="logout">
            {{ $t('Log Out') }}
          </responsive-nav-link>
        </div>
      </div>
    </div>
  </nav>
</template>

<script lang="ts">
  import route from 'ziggy-js'
  import { mainNav, headerNav } from '@admin/_nav'
  import { defineComponent, ref } from 'vue'
  import { Inertia } from '@inertiajs/inertia'

  export default defineComponent({
    setup() {
      const showingNavigationDropdown = ref(false)

      const logout = () => {
        Inertia.post(route('logout'))
      }

      return { showingNavigationDropdown, logout, mainNav, headerNav }
    },
  })
</script>
