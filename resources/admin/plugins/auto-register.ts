import { App } from 'vue'

export default {
  install: (app: App): void => {
    const components = import.meta.globEager('../components/**/*.vue')

    Object.entries(components).forEach(([path, definition]) => {
      const componentName = path
        .split('/')
        .pop()
        .replace(/\.\w+$/, '')

      app.component(componentName, definition.default)
    })
  },
}
