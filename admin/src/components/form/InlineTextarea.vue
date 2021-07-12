<template>
    <CRow>
        <CCol sm="12">
            <CTextarea v-if="readonly" :label="label" :value="value" readonly horizontal rows="3" />
            <CTextarea v-else :label="label" :value="value" @change="changeValue" horizontal rows="3"/>
        </CCol>
    </CRow>
</template>

<script>
export default {
  name: 'InlineTextarea',
  props: {
    label: '',
    value: '',
    readonly: false
  },
  methods: {
    changeValue (value) {
      this.$emit('update:value', value)
    }
  }
}
</script>
