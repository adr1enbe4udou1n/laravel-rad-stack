import './app.css'

import { createApp, h } from 'vue'
import {
  App as InertiaApp,
  plugin as InertiaPlugin,
} from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'

import AppLayout from './Layouts/AppLayout.vue'

import autoRegister from './Plugins/AutoRegister'
import Helpers from './Plugins/Helperss'

// Global Ziggy route function
declare const route: string

const el = document.getElementById('app')

const app = createApp({
  render: () =>
    h(InertiaApp, {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: (name) =>
        import(`./Pages/${name}.vue`).then(({ default: page }) => {
          if (page.layout === undefined && !name.startsWith('Auth/')) {
            page.layout = AppLayout
          }

          return page
        }),
    }),
})
  .mixin({ methods: { route } })
  .use(Helpers)
  .use(InertiaPlugin)

autoRegister(app)
app.mount(el)

InertiaProgress.init({ color: '#4B5563' })
