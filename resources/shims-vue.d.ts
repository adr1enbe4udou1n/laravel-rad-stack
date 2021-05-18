import { __ } from 'matice'
import { DefineComponent } from 'vue'
import route from 'ziggy-js'

declare module '*.vue' {
  const component: DefineComponent<
    Record<string, never>,
    Record<string, never>,
    unknown
  >
  export default component
}

declare module '@vue/runtime-core' {
  interface ComponentCustomProperties {
    $t: typeof __
    route: typeof route
  }
}

declare module '@inertiajs/inertia' {
  namespace Inertia {
    interface PagePropsBeforeTransform extends PageProps {}
    interface PageProps {
      appName: string
      user: { name: string; email: string }
      flash: any
      errors: { [key: string]: string }
    }
  }
}
