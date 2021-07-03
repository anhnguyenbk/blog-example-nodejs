<template>
  <div>
    <CModal
      title="Confirm delete"
      color="danger"
      :show.sync="show"
      @update:show="closeModal"
    >
      Do you really want to delete this record? This process cannot be undone.
    </CModal>
  </div>
</template>

<script>
import sunnyApiClient from '../../integrations/SunnyApiClient';
export default {
  name: 'DeleteConfirmationModel',
  data () {
    return {
      show: false
    }
  },
  methods: {
    open (recordId) {
      this.show = true;
      this.recordId = recordId;
    },
    async closeModal(show, e) {
      if (e.target.classList.contains('btn-danger')) {
        try{
          await sunnyApiClient.delete(`${this.baseApiPath}/${this.recordId}`);
          this.$emit('deletion', true);
        } catch (err) {
          console.log ("Deletion has error:" + err);
          this.$emit('deletion', false);
        }
      }
    }
  },
  props: ['baseApiPath', 'title']
}
</script>