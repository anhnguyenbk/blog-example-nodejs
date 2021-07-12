<template>
  <CRow>
    <CCol sm="12">
      <label for="editor">Content</label>
      <froala id="editor" :tag="'textarea'" :config="config"
              :value="content" v-on:input="onTextChange"></froala>
    </CCol>
  </CRow>
</template>


<script>
//https://github.com/ankurk91/vue-trumbowyg
//https://github.com/froala/vue-froala-wysiwyg/
//summernote
//quill

export default {
  name: 'Editor',
  data() {
    return {
      config: {}
    }
  },
  props: ['content'],
  methods: {
    onTextChange(value) {
      this.$emit('update:content', value)
    }
  }
}
</script>
