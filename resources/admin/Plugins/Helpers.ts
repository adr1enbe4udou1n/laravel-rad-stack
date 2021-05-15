import { usePage } from '@inertiajs/inertia-vue3'
import { App } from 'vue'

export default {
  install: (app: App): void => {
    app.config.globalProperties.$title = (title: string) => {
      return `${title} - ${(usePage().props.value as any).appName}`
    }
  },
}
