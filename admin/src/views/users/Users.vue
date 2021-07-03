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
             <template #roles="data">
              <td>
                <CBadge v-for="role in data.item.roles" :key="role" :color="getRoleColor(role)" class="m-1">
                  {{capitalizeFirstLetter(role)}}
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
import sunnyApiClient from '../../integrations/SunnyApiClient';
import StringUtils from '../../utils/StringUtils';

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
        { key: 'roles' },
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
    getRoleColor (role) {
      switch (role) {
        case 'admin': return 'danger'
        case 'user': return 'success'
        default: 'primary'
      }
    },
    rowClicked (item, index) {
      this.$router.push({path: `users/${item.id}`})
    },
    pageChange (val) {
      this.$router.push({ query: { page: val }})
    },
    capitalizeFirstLetter(str) {
      return StringUtils.capitalizeFirstLetter(str);
    },
  },
  async mounted () {
    const users = await sunnyApiClient.get('users');
    this.items = users
  },
}
</script>
