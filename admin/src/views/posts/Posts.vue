<template>
  <CRow>
    <CCol col="12" xl="12">
      <CCard>
        <CCardHeader>
          Posts
        </CCardHeader>
        <CCardBody>
           <DeleteConfirmationModel ref="deleteConfirmationModel" baseApiPath="post" 
            @deletion="itemDeletion" />
          <CDataTable
            hover
            striped
            table-filter
            :items="items"
            :fields="fields"
            items-per-page-select
            :items-per-page="10"
            clickable-rows
            :active-page="activePage"
            :pagination="{ doubleArrows: false, align: 'center'}"
            @page-change="pageChange"
          >
            <template #status="data">
              <td>
                <CBadge :color="getBadge(data.item.status)">
                  {{data.item.status}}
                </CBadge>
              </td>
            </template>
            <template #actions="data">
              <ActionButtons baseUrl="/posts" :item="data.item" />
            </template>

            <!-- <template #status="data">
              <td>
                <CBadge :color="getBadge(data.item.status)">
                  {{data.item.status}}
                </CBadge>
              </td>
            </template>
             <template #roles="data">
              <td>
                <CBadge v-for="role in data.item.roles" :key="role" :color="getRoleColor(role)" class="m-1">
                  {{capitalizeFirstLetter(role)}}
                </CBadge>
              </td>
            </template> -->
          </CDataTable>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import store from '../../store';
import sunnyApiClient from '../../integrations/SunnyApiClient';
import ActionButtons from '../../components/table/ActionButtons.vue';
import DeleteConfirmationModel from '../../components/notification/DeleteConfirmationModel.vue';

export default {
  name: 'Posts',
  components: {
    DeleteConfirmationModel,
    ActionButtons
  },
  data () {
    return {
      items: [],
      fields: [
          { key: 'id', label: 'Id'},
          // { key: 'registered' },
          { key: 'title' ,  _classes: ['font-weight-bold', 'w-25'] },
          { key: 'description', _classes: ['w-25']},
          { key: 'createdAt' },
          { key: 'actions', label: 'Actions'}
      ],
      activePage: 1
    }
  },
  methods: {
    getBadge (status) {
      switch (status) {
          case 'Draft': return 'warning'
          case 'Published': return 'success'
          default: 'primary'
      }
    },
    async loadTableItems() {
      const posts = await sunnyApiClient.get('posts');
      // console.log (users)
      this.items = posts
    },
    pageChange (val) {
      this.$router.push({ query: { page: val }})
    },
    itemDeletion (result) {
      if (result) {
        // reload
        this.loadTableItems();
      } else {
        store.commit ('showToast', store.getters.ToastType.Error);
      }
    }
  },
  async mounted () {
    await this.loadTableItems();
  },
}
</script>