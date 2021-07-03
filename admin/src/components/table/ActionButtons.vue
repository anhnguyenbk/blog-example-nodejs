<template>
  <td>
    <span class="d-inline-block" v-on:click="edit">
      <CIcon name="cil-pencil" />
    </span>
    <span class="d-inline-block" v-on:click="_delete">
      <CIcon name="cil-trash" />
    </span>
  </td>
</template>

<script>
export default {
  inheritAttrs: true,
  name: "ActionButtons",
  methods: {
    edit (event) {
      this.$router.push({path: `${this.baseUrl}/${this.item.id}`})
    },
    _delete (event) {
      let cardBody = (this.$parent.$parent);
      cardBody.$refs.deleteConfirmationModel.open(this.item.id);
    }
  },
  props: ['baseUrl', 'item']
}
</script>