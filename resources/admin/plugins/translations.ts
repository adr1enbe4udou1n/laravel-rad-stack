import { App } from 'vue'

import { __, transChoice, trans } from 'matice'

export const transAttribute = (resource: string, field: string) => {
  try {
    return trans(`crud.${resource}.attributes.${field}`)
  } catch {
    try {
      return trans(`admin.attributes.${field}`)
    } catch {
      return ''
    }
  }
}

export default {
  install: (app: App): void => {
    app.config.globalProperties.$t = __
    app.config.globalProperties.$tc = transChoice
    app.config.globalProperties.$ta = transAttribute
  },
}

declare module '@vue/runtime-core' {
  interface ComponentCustomProperties {
    $t: typeof __
    $tc: typeof transChoice
    $ta: typeof transAttribute
  }
}
