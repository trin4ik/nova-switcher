<template>
  <PanelItem :index="index" :field="field">
    <template v-slot:value><index-field :resource-id="resourceId" :resource-name="resourceName" :field="field"/></template>
  </PanelItem>
</template>

<script>

import IndexField from './IndexField.vue'

export default {
  components: {'index-field': IndexField},
  props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],
}
</script>
