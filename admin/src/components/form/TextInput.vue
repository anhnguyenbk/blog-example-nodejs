<template>
    <CRow>
        <CCol sm="12">
            <CInput v-if="readonly" :label="label" :value="value" readonly horizontal/>
            <CInput v-else :label="label" :value="value" @change="changeValue" horizontal/>
        </CCol>
    </CRow>
</template>

<script>
export default {
  name: 'TextInput',
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
