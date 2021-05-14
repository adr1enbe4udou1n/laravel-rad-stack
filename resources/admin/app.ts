import { createApp, h } from 'vue'
import {
  App as InertiaApp,
  plugin as InertiaPlugin,
} from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'

import AppLayout from './Layouts/AppLayout.vue'
import AuthLayout from './Layouts/AuthLayout.vue'
// import axios from 'axios'

// Global Ziggy route function
declare const route: string
// window.axios = axios
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

const el = document.getElementById('app')

createApp({
  render: () =>
    h(InertiaApp, {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: (name) =>
        import(`./Pages/${name}.vue`).then(({ default: page }) => {
          if (page.layout === undefined) {
            page.layout = AppLayout
            if (name.startsWith('Auth/')) {
              page.layout = AuthLayout
            }
          }
          return page
        }),
    }),
})
  .mixin({ methods: { route } })
  .use(InertiaPlugin)
  .mount(el)

InertiaProgress.init({ color: '#4B5563' })
