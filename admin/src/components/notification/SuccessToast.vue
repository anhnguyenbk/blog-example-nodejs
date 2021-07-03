<template>
    <CToaster :autohide="3000">
        <template v-for="toast in fixedToasts">
        <CToast
            :key="'successToast' + toast"
            :show="true"
            header="Successfully saved"
            color="success"
        >
        The item has been saved successfully.
        </CToast>
         </template>
    </CToaster>
</template>

<script>
export default {
  name: 'SuccessToast',
  data() {
      return {
          fixedToasts: 0
      }
  },
  methods: {
      show() {
          this.fixedToasts += 1;
      }
  }
}
</script>
