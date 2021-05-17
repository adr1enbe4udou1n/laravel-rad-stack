import { usePage } from '@inertiajs/inertia-vue3'
import { __ } from 'matice'
import { useTitle as vueUsetitle } from '@vueuse/core'
import { Ref } from 'vue'

export const useTitle = (title: string): Ref<string> => {
  return vueUsetitle(`${__(title)} - ${(usePage().props.value as any).appName}`)
}
