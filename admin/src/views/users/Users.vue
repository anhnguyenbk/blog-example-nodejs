<template>
  <CRow>
    <CCol col="12" xl="12">
      <CCard>
        <CCardHeader>
          Users
        </CCardHeader>
        <CCardBody>
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
            @row-clicked="rowClicked"
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
          </CDataTable>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
// import usersData from './UsersData'
import sunnyApiClient from '../../integrations/SunnyApiClient';

export default {
  name: 'Users',
  data () {
    return {
      items: [],
      fields: [
        { key: 'name', label: 'Name', _classes: 'font-weight-bold' },
        // { key: 'registered' },
        { key: 'email' },
        { key: 'status' },
        { key: 'created_at' }
      ],
      activePage: 1
    }
  },
  watch: {
    $route: {
      immediate: true,
      handler (route) {
        if (route.query && route.query.page) {
          this.activePage = Number(route.query.page)
        }
      }
    }
  },
  methods: {
    getBadge (status) {
      switch (status) {
        case 'Active': return 'success'
        case 'Inactive': return 'secondary'
        case 'Pending': return 'warning'
        case 'Banned': return 'danger'
        default: 'primary'
      }
    },
    rowClicked (item, index) {
      this.$router.push({path: `users/${index + 1}`})
    },
    pageChange (val) {
      this.$router.push({ query: { page: val }})
    }
  },
  async mounted () {
    const { data: users } = await sunnyApiClient.get('users');
    console.log (users)
    this.items = users
  },
}
</script>
