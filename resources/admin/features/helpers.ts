import { usePage } from '@inertiajs/inertia-vue3'
import { __, TranslationOptions } from 'matice'
import { useTitle as vueUsetitle } from '@vueuse/core'
import { Inertia } from '@inertiajs/inertia'

export function useTitle(title: string, options?: TranslationOptions): string {
  const subTitle = __(title, options)
  vueUsetitle(
    `${subTitle} - ${usePage<Inertia.PageProps>().props.value.appName}`
  )
  return subTitle
}

export function useUniqueId(): string {
  return Math.random().toString(36).substr(2, 9)
}
