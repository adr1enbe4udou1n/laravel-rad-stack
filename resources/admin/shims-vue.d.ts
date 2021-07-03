import { Profile, EnumTypes } from '@admin/types'
import { ErrorBag, Errors } from '@inertiajs/inertia'

declare module '@inertiajs/inertia' {
  interface PageProps {
    appName: string
    query: string
    auth: Profile
    flash: { [key: string]: string }
    errors: Errors & ErrorBag
    enums: EnumTypes
    [key: string]: unknown
  }
}
