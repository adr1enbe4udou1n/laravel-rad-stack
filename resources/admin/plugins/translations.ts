import { App } from 'vue'

import { __, trans, transChoice, TranslationOptions } from 'matice'

export default {
  install: (app: App): void => {
    app.config.globalProperties.$t = __
    app.config.globalProperties.$tc = transChoice
    app.config.globalProperties.$tif = (
      key: string,
      options?: TranslationOptions
    ) => {
      try {
        return trans(key, options)
      } catch {
        return ''
      }
    }
  },
}

declare module '@vue/runtime-core' {
  interface ComponentCustomProperties {
    $t: typeof __
    $tc: typeof transChoice
    $tif: typeof __
  }
}
