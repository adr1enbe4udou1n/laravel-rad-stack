import { Profile, EnumTypes } from '@admin/types'
import { ComputedRef, DefineComponent } from 'vue'

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
      auth: Profile
      flash: { [key: string]: string }
      errors: { [key: string]: string }[]
      enums: EnumTypes
    }

    interface Page {
      props: ComputedRef<Inertia.PageProps>
      url: ComputedRef<string>
      component: ComputedRef<string>
      version: ComputedRef<string | null>
    }
  }
}
