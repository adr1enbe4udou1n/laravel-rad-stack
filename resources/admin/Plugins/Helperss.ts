import { App } from 'vue'

export default {
  install: (app: App): void => {
    app.config.globalProperties.$title = (title: string) => {
      return `${title} - Laravel`
    }
  },
}
