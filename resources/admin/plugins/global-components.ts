import TextField from '@admin/components/fields/TextField.vue'
import EmailField from '@admin/components/fields/EmailField.vue'
import BooleanField from '@admin/components/fields/BooleanField.vue'
import SwitchField from '@admin/components/fields/SwitchField.vue'
import DateField from '@admin/components/fields/DateField.vue'
import SelectField from '@admin/components/fields/SelectField.vue'
import ReferenceField from '@admin/components/fields/ReferenceField.vue'
import ImageField from '@admin/components/fields/ImageField.vue'
import FileField from '@admin/components/fields/FileField.vue'

import TextFilter from '@admin/components/filters/TextFilter.vue'
import SelectFilter from '@admin/components/filters/SelectFilter.vue'
import BooleanFilter from '@admin/components/filters/BooleanFilter.vue'
import ReferenceFilter from '@admin/components/filters/ReferenceFilter.vue'
import DateFilter from '@admin/components/filters/DateFilter.vue'

import draggable from 'vuedraggable'

import { App } from 'vue'

export default {
  install: (app: App): void => {
    app.component('TextField', TextField)
    app.component('EmailField', EmailField)
    app.component('BooleanField', BooleanField)
    app.component('SwitchField', SwitchField)
    app.component('SelectField', SelectField)
    app.component('DateField', DateField)
    app.component('ReferenceField', ReferenceField)
    app.component('ImageField', ImageField)
    app.component('FileField', FileField)

    app.component('TextFilter', TextFilter)
    app.component('SelectFilter', SelectFilter)
    app.component('BooleanFilter', BooleanFilter)
    app.component('ReferenceFilter', ReferenceFilter)
    app.component('DateFilter', DateFilter)

    app.component('Draggable', draggable)
  },
}
