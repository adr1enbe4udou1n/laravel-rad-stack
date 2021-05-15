import './app.css'

import { createApp, h } from 'vue'
import {
  App as InertiaApp,
  plugin as InertiaPlugin,
} from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'

import AppLayout from './Layouts/AppLayout.vue'

import AutoRegister from './pPlugins/AutoRegister'
import Route from './pPlugins/Route'
import Translations from './pPlugins/Translations'
import Helpers from './pPlugins/Helpers'

const el = document.getElementById('app')

const app = createApp({
  render: () =>
    h(InertiaApp, {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: (name) =>
        import(`./pages/${name}.vue`).then(({ default: page }) => {
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
