import { App } from 'vue'

import { format } from 'date-fns'

export default {
  install: (app: App): void => {
    app.config.globalProperties.$dateFormat = format
  },
}

declare module '@vue/runtime-core' {
  interface ComponentCustomProperties {
    $dateFormat: typeof format
  }
}
