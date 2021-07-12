<template>
    <CRow>
        <CCol sm="12">
          <CInput :label="label" :value="value" @change="changeValue" :readonly="readonly" horizontal>
            <template #append>
              <CButton type="button" color="warning" v-on:click="toEditMode">Edit</CButton>
            </template>
          </CInput>
        </CCol>
    </CRow>
</template>

<script>
export default {
  name: 'InlineLinkInput',
  data() {
    return {
      readonly: true,
    }
  },
  props: {
    label: '',
    value: ''
  },
  methods: {
    toEditMode (e) {
      this.readonly = false
    },
    changeValue (value) {
      this.$emit('update:value', value)
    }
  }
}
</script>
