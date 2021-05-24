import { __ } from 'matice'
import route from 'ziggy-js'

interface NavLink {
  href: string
  active: () => boolean
  icon: string
  text: string
}

const mainNav: NavLink[] = [
  {
    href: route('admin.dashboard'),
    active: () => route().current('admin.dashboard'),
    icon: 'chart-bar',
    text: __('Dashboard'),
  },
  {
    href: route('admin.users.index'),
    active: () => route().current('admin.users.*'),
    icon: 'users',
    text: __('Users'),
  },
]

const headerNav: NavLink[] = [
  {
    href: route('admin.dashboard'),
    active: () => route().current('admin.dashboard'),
    icon: 'chart-bar',
    text: __('Dashboard'),
  },
  {
    href: route('admin.users.index'),
    active: () => route().current('admin.users.*'),
    icon: 'users',
    text: __('Users'),
  },
]

export { mainNav, headerNav }
