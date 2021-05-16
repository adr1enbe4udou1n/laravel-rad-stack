import './app.css'

import { createApp, h } from 'vue'
import {
  App as InertiaApp,
  plugin as InertiaPlugin,
} from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'

import AppLayout from './layouts/AppLayout.vue'

import AutoRegister from './plugins/auto-register'
import Route from './plugins/route'
import Translations from './plugins/translations'
import Helpers from './plugins/helpers'

const el = document.getElementById('app')

const app = createApp({
  render: () =>
    h(InertiaApp, {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: (name) =>
        import(`./pages/${name}.vue`).then((component) => component.default),
    }),
})
  .use(AutoRegister)
  .use(Route)
  .use(Translations)
  .use(Helpers)
  .use(InertiaPlugin)

app.mount(el)

InertiaProgress.init({ color: '#4B5563' })
