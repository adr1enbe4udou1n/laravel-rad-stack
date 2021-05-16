import { App } from 'vue'
import route from 'ziggy-js'

export { route }

export default {
  install: (app: App): void => {
    app.config.globalProperties.route = route
  },
}
