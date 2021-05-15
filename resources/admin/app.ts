import './app.css'

import { createApp, h } from 'vue'
import {
  App as InertiaApp,
  plugin as InertiaPlugin,
} from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'

import AppLayout from './Layouts/AppLayout.vue'

import AutoRegister from './Plugins/AutoRegister'
import Route from './Plugins/Route'
import Translations from './Plugins/Translations'
import Helpers from './Plugins/Helpers'

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
  .use(Route)
  .use(Translations)
  .use(Helpers)
  .use(InertiaPlugin)

AutoRegister(app)
app.mount(el)

InertiaProgress.init({ color: '#4B5563' })
