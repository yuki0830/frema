<template>
  <div class="modal">
    <div class="modal__bg"></div>
    <div class="modal__content">
      <p>AddSalesForm</p>
      <button @click="hideModal">closeModal</button>
    </div>
  </div>
</template>

<script>
  import { mapMutations } from 'vuex'
  import MultiModalMixin from '../../mixins/MultiModalMixin'
  export default {
    name: 'AddSalesForm',
    mixins: [MultiModalMixin]
  }
</script>