import { App } from 'vue'

import { __, transChoice } from 'matice'

export default {
  install: (app: App): void => {
    app.config.globalProperties.$t = __
    app.config.globalProperties.$tc = transChoice
  },
}
