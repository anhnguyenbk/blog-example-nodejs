<template>
  <CRow>
    <CCol col="12" lg="12">
      <CCard>
        <CCardHeader>
          User id: {{ $route.params.id }}
        </CCardHeader>
        <CCardBody>
          <InlineInput label="Name" :value="details.name" readonly="true" />
          <InlineInput label="Email" :value="details.email" readonly="true" />
          <CRow>
            <CCol sm="12">
              <CSelect label="Status" :options="statuses" :value.sync="details.status" horizontal />
            </CCol>
          </CRow>
          <InlineInput label="Created at" :value="details.created_at" readonly="true" />
        </CCardBody>
        <CCardFooter>
          <div class="card-footer-action-buttons float-right">
            <CButton color="secondary" @click="goBack" style="margin-right: 10px;">Back</CButton>
            <CButton color="primary" @click="save">Save</CButton>
          </div>
        </CCardFooter>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
  import store from '../../store';
  import sunnyApiClient from '../../integrations/SunnyApiClient';
  import SuccessToast from '../../components/notification/SuccessToast.vue';
  import InlineInput from "../../components/form/InlineInput.vue";
  import InlineSelect from "../../components/form/InlineSelect.vue";

  export default {
    name: 'User',
    beforeRouteEnter(to, from, next) {
      next(vm => {
        vm.usersOpened = from.fullPath.includes('users')
      })
    },
    components: {
      SuccessToast,
      InlineInput,
      InlineSelect
    },
    data() {
      return {
        statuses: [],
        details: {}
      }
    },
    methods: {
      goBack() {
        this.details ? this.$router.go(-1) : this.$router.push({
          path: '/users'
        })
      },
      async save() {
        const id = this.$route.params.id
        var requestBody = {
          status: this.details.status
        }

        try {
          var res = await sunnyApiClient.put(`user/${id}`, requestBody)
          store.commit ('showToast', store.getters.ToastType.SuccessfullySaved);
        } catch (err) {
          store.commit ('showToast', store.getters.ToastType.Error);
        }
      }
    },
    async mounted() {
      // console.log ("Mountted")
      const id = this.$route.params.id
      const statuses = await sunnyApiClient.get(`users/statuses`);
      const user = await sunnyApiClient.get(`user/${id}`);
      //console.log (user)
      //console.log (statuses)
      this.statuses = statuses;
      this.details = user;
    }
  }
</script>