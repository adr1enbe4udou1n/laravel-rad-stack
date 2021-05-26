import { Profile, EnumTypes } from '@admin/types'
import { DefineComponent } from 'vue'

declare module '*.vue' {
  const component: DefineComponent<
    Record<string, never>,
    Record<string, never>,
    unknown
  >
  export default component
}

declare module '@inertiajs/inertia' {
  namespace Inertia {
    interface PagePropsBeforeTransform extends PageProps {}
    interface PageProps {
      appName: string
      user: Profile
      flash: any
      errors: { [key: string]: string }
      enums: EnumTypes
    }
  }
}
