import { App } from 'vue'

import { __, trans, transChoice } from 'matice'

export default {
  install: (app: App): void => {
    app.config.globalProperties.$__ = __
    app.config.globalProperties.$t = trans
    app.config.globalProperties.$tc = transChoice
  },
}
