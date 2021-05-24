import {
  UserIcon,
  LoginIcon,
  LogoutIcon,
  LockClosedIcon,
  LockOpenIcon,
  PlusIcon,
  TrashIcon,
  XIcon,
} from 'heroicons-vue3/outline'

import { App } from 'vue'

export default {
  install: (app: App): void => {
    app.component('UserIcon', UserIcon)
    app.component('LoginIcon', LoginIcon)
    app.component('LogoutIcon', LogoutIcon)
    app.component('LockClosedIcon', LockClosedIcon)
    app.component('LockOpenIcon', LockOpenIcon)
    app.component('PlusIcon', PlusIcon)
    app.component('TrashIcon', TrashIcon)
    app.component('XIcon', XIcon)
  },
}
