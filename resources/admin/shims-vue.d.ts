import { Profile, EnumTypes } from '@admin/types'
import { ComputedRef } from 'vue'

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
