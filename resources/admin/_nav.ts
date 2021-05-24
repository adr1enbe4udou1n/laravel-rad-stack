import { __ } from 'matice'

interface SidebarLink {
  routeName: string
  icon: string
  text: string
}

const nav: SidebarLink[] = [
  {
    routeName: 'admin.dashboard',
    icon: 'chart-bar',
    text: __('Dashboard'),
  },
  {
    routeName: 'admin.users',
    icon: 'users',
    text: __('Users'),
  },
]

export default nav
