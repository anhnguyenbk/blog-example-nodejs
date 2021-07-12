<template>
  <CRow>
    <CModal
        title="Add Category"
        color="primary"
        :show.sync="categoryModal"
        @update:show="closeCategoryModal"
    >
      <div>
        <CRow>
          <CCol sm="12">
            <CInput
                label="Name"
                placeholder="Category name"
                :value.sync="selected.name"
            />
          </CCol>
        </CRow>
      </div>
    </CModal>

    <DeleteConfirmationModel ref="deleteConfirmationModel" baseApiPath="category" @deletion="itemDeletion"/>

    <CCol col="12" xl="12">
      <CCard>
        <CCardHeader>
          Categories Tree
        </CCardHeader>
        <CCardBody>
          <CRow>
            <CCol sm="12" md="12">
              <CategoriesTree class="item"
                              :item="treeData"
                              @add-item="addItem"
                              @edit-item="editItem"
                              @delete-item="deleteItem"
                              @update-order="updateOrder"/>
            </CCol>
          </CRow>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import store from '../../store';
import sunnyApiClient from "../../integrations/SunnyApiClient";
import CategoriesTree from "./CategoriesTree";
import DeleteConfirmationModel from '../../components/notification/DeleteConfirmationModel.vue';

export default {
  name: "Categories",
  components: {
    CategoriesTree,
    DeleteConfirmationModel
  },
  data() {
    return {
      treeData: {},
      selected: {
        name: ''
      },
      categoryModal: false
    }
  },
  methods: {
    addItem(item) {
      // console.log('add item');
      // console.log(item);
      this.selected = {
        id: null,
        parent_id: item.id,
        order: item.children.length + 1,
        name: ''
      }
      this.categoryModal = true;
    },
    editItem(item) {
      this.selected = item;
      this.categoryModal = true;
    },
    deleteItem(item) {
      this.$refs.deleteConfirmationModel.open(item.id);
    },
    closeCategoryModal(status, evt, accept) {
      if (accept) {
        // console.log("ok presses");
        // console.log(this.selected);
        if (this.selected.id == null) {
          this.addCategory();
        } else {
          this.updateCategory();
        }
      }
    },
    async addCategory() {
      var reqBody = {
        name: this.selected.name,
        order: this.selected.order,
        parent_id: this.selected.parent_id
      }
      try {
        await sunnyApiClient.post('categories', reqBody);
        store.commit('showToast', store.getters.ToastType.SuccessfullySaved);
        await this.loadTree();
      } catch (err) {
        store.commit('showToast', store.getters.ToastType.Error);
      }
    },
    async updateCategory() {
      var reqBody = {
        name: this.selected.name,
        order: this.selected.order,
        parent_id: this.selected.parent_id
      }
      try {
        await sunnyApiClient.put(`category/${this.selected.id}`, reqBody);
        store.commit('showToast', store.getters.ToastType.SuccessfullySaved);
        await this.loadTree();
      } catch (err) {
        store.commit('showToast', store.getters.ToastType.Error);
      }
    },
    async itemDeletion(result) {
      if (result) {
        await this.loadTree();
      } else {
        store.commit('showToast', store.getters.ToastType.Error);
      }
    },
    async updateOrder (item) {
      try {
        await sunnyApiClient.post(`categories/order`, item);
      } catch (err) {
        store.commit('showToast', store.getters.ToastType.Error);
      }
    },
    async loadTree() {
      var categories = await sunnyApiClient.get(`categories-hierarchy`);
      this.treeData = {
        name: "Categories Tree",
        children: categories
      }
    }
  },
  async mounted() {
    await this.loadTree();
  }
}
</script>
