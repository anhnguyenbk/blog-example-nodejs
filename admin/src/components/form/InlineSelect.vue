<template>
    <CRow>
        <CCol sm="12">
            <CSelect v-if="readonly" :label="label" :options="options" :value="value" readonly horizontal />
            <CSelect v-else :label="label" :options="options" @update="updateValue($event)" horizontal />
        </CCol>
    </CRow>
</template>

<script>
    export default {
        name: 'InlineSelect',
        props: {
            label: '',
            options: [],
            value: '',
            readonly: false
        },
        methods: {
            updateValue: function (value) {
                console.log (value);
                //this.$emit('input', value);
            }
        }
    }
</script>