import { Profile, EnumTypes } from '@admin/types'
import { Inertia } from '@inertiajs/inertia'
import { Page, Errors, ErrorBag } from '@inertiajs/inertia/types/types'
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
      auth: Profile
      flash: any
      errors: Errors & ErrorBag
      enums: EnumTypes
    }

    interface CustomPage extends Page {
      props: PageProps
    }
  }
}

declare module '@vue/runtime-core' {
  export interface ComponentCustomProperties {
    $page: Inertia.CustomPage
  }
}
