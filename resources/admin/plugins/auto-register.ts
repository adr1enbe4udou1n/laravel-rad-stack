import { App } from 'vue'

export default {
  install: (app: App): void => {
    const components = import.meta.globEager('../components/**/*.vue')
    const layouts = import.meta.globEager('../layouts/*.vue')

    Object.entries({ ...components, ...layouts }).forEach(
      ([path, definition]) => {
        const componentName = path
          .split('/')
          .pop()
          .replace(/\.\w+$/, '')

        app.component(componentName, definition.default)
      }
    )
  },
}
