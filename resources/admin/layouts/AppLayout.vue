<template>
  <div>
    <banner />

    <div class="min-h-screen bg-gray-100">
      <nav class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
            <div class="flex">
              <!-- Logo -->
              <div class="flex-shrink-0 flex items-center">
                <inertia-link :href="route('admin.dashboard')">
                  <svg
                    class="block h-9 w-auto"
                    viewBox="0 0 48 48"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z"
                      fill="#6875F5"
                    />
                    <path
                      d="M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z"
                      fill="#6875F5"
                    />
                  </svg>
                </inertia-link>
              </div>

              <!-- Navigation Links -->
              <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <nav-link
                  :href="route('admin.dashboard')"
                  :active="route().current('admin.dashboard')"
                >
                  {{ $t('Dashboard') }}
                </nav-link>
                <nav-link
                  :href="route('admin.users')"
                  :active="route().current('admin.users')"
                >
                  {{ $t('Users') }}
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

                        <svg
                          class="ml-2 -mr-0.5 h-4 w-4"
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                          />
                        </svg>
                      </button>
                    </span>
                  </template>

                  <template #content>
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                      {{ $t('Manage Account') }}
                    </div>

                    <dropdown-link
                      :href="route('admin.profile.show')"
                      icon="user"
                    >
                      {{ $t('Profile') }}
                    </dropdown-link>

                    <div class="border-t border-gray-100"></div>

                    <!-- Authentication -->
                    <form @submit.prevent="logout">
                      <dropdown-link icon="logout">
                        {{ $t('Log Out') }}
                      </dropdown-link>
                    </form>
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
                  text-gray-400
                  hover:text-gray-500
                  hover:bg-gray-100
                  focus:outline-none
                  focus:bg-gray-100
                  focus:text-gray-500
                  transition
                "
                @click="showingNavigationDropdown = !showingNavigationDropdown"
              >
                <svg
                  class="h-6 w-6"
                  stroke="currentColor"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <path
                    :class="{
                      hidden: showingNavigationDropdown,
                      'inline-flex': !showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                  />
                  <path
                    :class="{
                      hidden: !showingNavigationDropdown,
                      'inline-flex': showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
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
              :href="route('admin.dashboard')"
              :active="route().current('admin.dashboard')"
            >
              {{ $t('Dashboard') }}
            </responsive-nav-link>
            <responsive-nav-link
              :href="route('admin.users')"
              :active="route().current('admin.users')"
            >
              {{ $t('Users') }}
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
              <form method="POST" @submit.prevent="logout">
                <responsive-nav-link> Log Out </responsive-nav-link>
              </form>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Heading -->
      <header v-if="$slots.header" class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <slot name="header"></slot>
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <slot></slot>
      </main>
    </div>
  </div>
</template>

<script lang="ts">
  import { route } from '@admin/plugins/route'
  import { defineComponent, ref } from 'vue'
  import { Inertia } from '@inertiajs/inertia'

  export default defineComponent({
    setup() {
      const showingNavigationDropdown = ref(false)

      const logout = () => {
        Inertia.post(route('logout'))
      }

      return { showingNavigationDropdown, logout }
    },
  })
</script>
