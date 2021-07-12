<template>
  <CRow>
    <CCol col="12" lg="8">
      <CCard>
        <CCardHeader>
          Post id: {{ $route.params.id }}
        </CCardHeader>
        <CCardBody>
          <TextInput label="Title" :value.sync="details.title"/>
          <InlineLinkInput label="Link" :value.sync="details.link"/>
          <TextInput label="Order" :value.sync="details.order"/>
          <InlineTextarea label="Description" :value.sync="details.description"/>
          <Editor :content.sync="details.content"/>
        </CCardBody>
      </CCard>
    </CCol>

    <CCol col="12" lg="4">
      <CCard>
        <CCardHeader>
          Save
        </CCardHeader>
        <CCardBody>
          <CButton color="secondary" @click="save('Draft')">
            <CIcon name="cil-lock-locked"/>
            Save draft
          </CButton>
          <CButton color="primary" class="float-right" @click="save('Published')">
            <CIcon name="cil-lock-unlocked"/>
            Publish
          </CButton>
        </CCardBody>
      </CCard>

      <Categories />
      <FeatureImage/>
    </CCol>
  </CRow>
</template>

<script>
import sunnyApiClient from '../../integrations/SunnyApiClient';
import TextInput from "../../components/form/TextInput.vue";
import InlineTextarea from "../../components/form/InlineTextarea.vue";
import InlineLinkInput from "../../components/form/InlineLinkInput.vue";
import InlineSelect from "../../components/form/InlineSelect.vue";
import FeatureImage from '../widgets/FeatureImage.vue';
import StringUtils from '../../utils/StringUtils';
import Editor from '../../components/form/Editor.vue';
import Categories from "../widgets/Categories";

export default {
  name: 'Post',
  beforeRouteEnter(to, from, next) {
    next(vm => {
      vm.usersOpened = from.fullPath.includes('posts')
    })
  },
  components: {
    TextInput,
    InlineTextarea,
    InlineSelect,
    InlineLinkInput,
    FeatureImage,
    Editor,
    Categories
  },
  data() {
    return {
      details: {}
    }
  },
  methods: {
    goBack() {
      this.details ? this.$router.go(-1) : this.$router.push({
        path: '/posts'
      })
    },
    async save(saveType) {
      const id = this.$route.params.id;
      this.details.status = saveType;

      var requestBody = this.details;
      console.log(requestBody)

      try {
        //var res = await sunnyApiClient.put(`user/${id}`, requestBody)
        //store.commit ('showToast', store.getters.ToastType.SuccessfullySaved);
      } catch (err) {
        // store.commit ('showToast', store.getters.ToastType.Error);
      }
    }
  },
  watch: {
    'details.title': function (val) {
      this.details.link = StringUtils.toLink(val);
    }
  },
  async mounted() {
    const id = this.$route.params.id
    this.details = await sunnyApiClient.get(`post/${id}`);
  }
}
</script>