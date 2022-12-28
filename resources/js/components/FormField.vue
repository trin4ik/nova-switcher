<template>
  <DefaultField :field="field" :errors="errors" :show-help-text="showHelpText">
    <template #field>
      <index-field @change="setValue" :resource-id="resourceId" :resource-name="resourceName" :field.sync="field" :without-request="true" />
    </template>
  </DefaultField>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'
import IndexField from './IndexField.vue'

export default {
  components: {IndexField},
  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],

  methods: {

    setValue (value) {
      this.value = value
    },

    setInitialValue() {
      this.value = this.field.value
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append(this.field.attribute, Number(this.value))
    },
  }
}
</script>
