import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-nova-switcher', IndexField)
  app.component('detail-nova-switcher', DetailField)
  app.component('form-nova-switcher', FormField)
})
