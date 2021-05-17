import { usePage } from '@inertiajs/inertia-vue3'
import { __ } from 'matice'
import { useTitle as vueUsetitle } from '@vueuse/core'
import { Ref } from 'vue'

export function useTitle(title: string): Ref<string> {
  return vueUsetitle(`${__(title)} - ${usePage().props.value.appName}`)
}

export function useUniqueId(): string {
  return Math.random().toString(36).substr(2, 9)
}
