import {
  ChartBarIcon,
  ExclamationIcon,
  CheckCircleIcon,
  UserIcon,
  UsersIcon,
  LoginIcon,
  LogoutIcon,
  LockClosedIcon,
  LockOpenIcon,
  PlusIcon,
  TrashIcon,
  ArchiveIcon,
  CogIcon,
  AdjustmentsIcon,
  XIcon,
} from 'heroicons-vue3/outline'

import { App } from 'vue'

export default {
  install: (app: App): void => {
    app.component('ChartBarIcon', ChartBarIcon)
    app.component('ExclamationIcon', ExclamationIcon)
    app.component('CheckCircleIcon', CheckCircleIcon)
    app.component('UserIcon', UserIcon)
    app.component('UsersIcon', UsersIcon)
    app.component('LoginIcon', LoginIcon)
    app.component('LogoutIcon', LogoutIcon)
    app.component('LockClosedIcon', LockClosedIcon)
    app.component('LockOpenIcon', LockOpenIcon)
    app.component('PlusIcon', PlusIcon)
    app.component('TrashIcon', TrashIcon)
    app.component('ArchiveIcon', ArchiveIcon)
    app.component('CogIcon', CogIcon)
    app.component('AdjustmentsIcon', AdjustmentsIcon)
    app.component('XIcon', XIcon)
  },
}
