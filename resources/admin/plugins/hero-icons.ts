import {
  MenuIcon,
  ChartBarIcon,
  ExclamationIcon,
  CheckIcon,
  CheckCircleIcon,
  UserIcon,
  UsersIcon,
  LoginIcon,
  LogoutIcon,
  LockClosedIcon,
  LockOpenIcon,
  PlusIcon,
  PencilIcon,
  PencilAltIcon,
  EyeIcon,
  TrashIcon,
  ArchiveIcon,
  CogIcon,
  AdjustmentsIcon,
  XIcon,
  XCircleIcon,
  ChevronDoubleDownIcon,
  ChevronDoubleLeftIcon,
  ChevronDoubleRightIcon,
  ChevronDoubleUpIcon,
  ChevronDownIcon,
  ChevronLeftIcon,
  ChevronRightIcon,
  ChevronUpIcon,
} from 'heroicons-vue3/outline'

import {
  ChartBarIcon as ChartBarIconSolid,
  UsersIcon as UsersIconSolid,
} from 'heroicons-vue3/solid'

import { App } from 'vue'

export default {
  install: (app: App): void => {
    app.component('ChartBarIconSolid', ChartBarIconSolid)
    app.component('UsersIconSolid', UsersIconSolid)
    app.component('MenuIcon', MenuIcon)
    app.component('ChartBarIcon', ChartBarIcon)
    app.component('ExclamationIcon', ExclamationIcon)
    app.component('CheckIcon', CheckIcon)
    app.component('CheckCircleIcon', CheckCircleIcon)
    app.component('UserIcon', UserIcon)
    app.component('UsersIcon', UsersIcon)
    app.component('PencilIcon', PencilIcon)
    app.component('PencilAltIcon', PencilAltIcon)
    app.component('EyeIcon', EyeIcon)
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
    app.component('XCircleIcon', XCircleIcon)
    app.component('ChevronDoubleDownIcon', ChevronDoubleDownIcon)
    app.component('ChevronDoubleLeftIcon', ChevronDoubleLeftIcon)
    app.component('ChevronDoubleRightIcon', ChevronDoubleRightIcon)
    app.component('ChevronDoubleUpIcon', ChevronDoubleUpIcon)
    app.component('ChevronDownIcon', ChevronDownIcon)
    app.component('ChevronLeftIcon', ChevronLeftIcon)
    app.component('ChevronRightIcon', ChevronRightIcon)
    app.component('ChevronUpIcon', ChevronUpIcon)
  },
}
