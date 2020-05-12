<template>
  <transition name="fade">
    <component v-if="isShow" :is="modalName"></component>
  </transition>
</template>

<script>
import { mapState } from "vuex";
import ModalTypeA from "./ModalTypeA.vue";
import ModalTypeB from "./ModalTypeB.vue";
import EditItem from "./EditItem.vue";
import AddItem from "./AddItem.vue";
export default {
  name: "MultiModalView",
  components: {
    ModalTypeA,
    ModalTypeB,
    EditItem,
    AddItem
  },
  computed: {
    ...mapState("multiModal", ["modalName"]),
    isShow() {
      return this.modalName !== "";
    }
  }
};
</script>