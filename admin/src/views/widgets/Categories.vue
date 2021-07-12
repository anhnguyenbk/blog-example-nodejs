<template>
  <CCard>
    <CCardHeader>
      Categories
    </CCardHeader>
    <CCardBody>
      <ul id="category-list">
        <li v-for="item in categories" :key="item.id">
          <CInputCheckbox :label="item.name" custom/>
          <template v-if="item.children">
            <ul class="children-categories">
              <li v-for="child in item.children" :key="child.id">
                <CInputCheckbox :label="child.name" custom/>
              </li>
            </ul>
          </template>
        </li>
      </ul>
    </CCardBody>
  </CCard>
</template>

<!-- Using the `scoped` attribute -->
<style scoped>
  ul {
    padding: 0;
    list-style-type: none;
  }
  ul.children-categories {
    padding-left: 20px;
  }
</style>

<script>
  import sunnyApiClient from "../../integrations/SunnyApiClient";

  export default {
    name: 'Categories',
    data () {
      return {
        categories: []
      }
    },
    async mounted() {
      this.categories = await sunnyApiClient.get(`categories-hierarchy`);
    }
  }
</script>