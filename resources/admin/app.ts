import './app.css'

import { createApp, h } from 'vue'
import {
  App as InertiaApp,
  plugin as InertiaPlugin,
} from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'

import Route from './plugins/route'
import Translations from './plugins/translations'
import DateFns from './plugins/date-fns'
import HeroIcons from './plugins/hero-icons'

const el = document.getElementById('app')

if (el) {
  const app = createApp({
    render: () =>
      h(InertiaApp, {
        initialPage: JSON.parse(el.dataset.page as string),
        resolveComponent: (name) => {
          const pages = import.meta.globEager(`./pages/**/*`)

          return pages[`./pages/${name}.vue`].default
        },
      }),
  })
    .use(Route)
    .use(Translations)
    .use(DateFns)
    .use(InertiaPlugin)
    .use(HeroIcons)

  app.mount(el)

  InertiaProgress.init({ color: '#4B5563' })
}
