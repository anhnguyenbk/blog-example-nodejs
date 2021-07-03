<template>
    <CRow>
        <CCol sm="12">
            <CInput v-if="readonly" :label="label" :value="value" readonly horizontal />
            <CInput v-else :label="label" :value.sync="value" horizontal />
        </CCol>
    </CRow>
</template>

<script>
export default {
  name: 'InlineInput',
  props: {
    label: '',
    value: '',
    readonly: false
  }
}
</script>
