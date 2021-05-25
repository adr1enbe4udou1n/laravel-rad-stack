import { __ } from 'matice'
import route from 'ziggy-js'

interface NavTitle {
  title: string
}
interface NavLink {
  href: string
  active: () => boolean
  icon: string
  text: string
}

const mainNav: (NavLink | NavTitle)[] = [
  {
    href: route('admin.dashboard'),
    active: () => route().current('admin.dashboard'),
    icon: 'chart-bar',
    text: __('Dashboard'),
  },
  { title: __('Access Managment') },
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

const isTitle = (a: any): a is NavTitle => {
  return a.title !== undefined
}
const isLink = (a: any): a is NavLink => {
  return a.href !== undefined
}

export { NavLink, NavTitle, isTitle, isLink, mainNav, headerNav }
