<template>
  <CCard>
    <CCardHeader>
      Feature image
    </CCardHeader>
    <CCardBody>
      <img v-bind:src='image' class="w-100" style="margin-bottom: 1.25rem;"/>
      <CInputFile custom :placeholder="placeholder" @change="onChoose"/>
    </CCardBody>
  </CCard>
</template>
<script>
  import FileUtils from '../../utils/FileUtils'
  import store from '../../store'

  export default {
    name: 'FeatureImage',
    components: {
      FileUtils
    },
    data() {
      return {
        placeholder: 'Choose file...',
        image: ''
      }
    },
    methods: {
      async onChoose(files, event) {
        var file = files[0];
        this.placeholder = file.name;
        const base64 = await FileUtils.toBase64(file).catch(e => Error(e));
        if (base64 instanceof Error) {
          store.commit ('showToast', store.getters.ToastType.Error);
          return;
        }
        this.image = base64;
      }
    }
  }
</script>