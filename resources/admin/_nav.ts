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

const isTitle = (a: NavTitle | NavLink): a is NavTitle => {
  return (a as NavTitle).title !== undefined
}
const isLink = (a: NavTitle | NavLink): a is NavLink => {
  return (a as NavLink).href !== undefined
}

export { NavLink, NavTitle, isTitle, isLink, mainNav, headerNav }
