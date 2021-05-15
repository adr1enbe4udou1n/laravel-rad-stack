import { usePage } from '@inertiajs/inertia-vue3'
import { App } from 'vue'
import { useTrans } from './translations'

export default {
  install: (app: App): void => {
    app.config.globalProperties.$title = (title: string) => {
      return `${useTrans(title)} - ${(usePage().props.value as any).appName}`
    }
  },
}
