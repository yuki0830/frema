<template>
  <div class="item-list">
    <Item class="item" v-for="item in items" :key="item.id" :item="item" />
    <MultiModalView></MultiModalView>
  </div>
</template>

<script>
import { OK } from "../util";
import Item from "../components/Item.vue";
import MultiModalView from "../components/MultiModalView.vue";
import Pagination from "../components/Pagination.vue";
import { mapState } from "vuex";
import PathMixin from "../mixins/PathMixin";
export default {
  mixins: [PathMixin],
  components: {
    Item,
    Pagination,
    MultiModalView
  },
  props: {
    page: {
      type: Number,
      required: false,
      default: 1
    }
  },
  computed: {
    ...mapState("item", ["items"])
  },
  watch: {
    $route: {
      async handler() {
        await this.$store.dispatch("item/fetchItems");
      },
      immediate: true
    }
  },
};
</script>

<style lang="scss" scoped>
.item {
  margin-bottom: 10px;
}
.item-list {
  position: relative;
}
</style>