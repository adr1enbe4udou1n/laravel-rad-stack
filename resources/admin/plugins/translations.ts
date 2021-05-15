import { App } from 'vue'

import { __, transChoice } from 'matice'

export { __ as useTrans }

export default {
  install: (app: App): void => {
    app.config.globalProperties.$t = __
    app.config.globalProperties.$tc = transChoice
  },
}
