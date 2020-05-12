<template>
  <div class="item__wrapper">
    <mq-layout mq="lg"></mq-layout>
    <mq-layout mq="md"></mq-layout>
    <mq-layout mq="sm">
      <v-card class="mx-auto" max-width="400">
        <v-expansion-panels flat>
          <v-expansion-panel>
            <v-expansion-panel-header expand-icon="fas fa-chevron-down">
              <v-list-item>
                <v-list-item-avatar tile size="80">
                  <!-- <v-img
                    class="white--text align-end"
                    src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
                  ></v-img>-->
                  <v-img
                    class="white--text align-end"
                    :src="imageSrc"
                  ></v-img>
                </v-list-item-avatar>
                <v-list-item-content>
                  <v-list-item-title>{{ item.name }}</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-expansion-panel-header>
            <v-expansion-panel-content>
              <v-list-item>
                <ul>
                  <li>
                    <div>在庫</div>
                    <div>{{ item.stock }}</div>
                  </li>
                  <li>
                    <div>原価</div>
                    <div>
                      <span>&yen;</span>
                      {{ item.cost | addComma }}
                    </div>
                  </li>
                </ul>
              </v-list-item>
              <v-list-item>
                <ul>
                  <li>
                    <div>売上数</div>
                    <div>{{ item.cost }}</div>
                  </li>
                  <li>
                    <div>売上総額</div>
                    <div>
                      <span>&yen;</span>
                      {{ item.cost | addComma }}
                    </div>
                  </li>
                </ul>
              </v-list-item>
              <v-list-item>
                <ul>
                  <li>
                    <div>利益率</div>
                    <div>
                      12.4
                      <span>%</span>
                    </div>
                  </li>
                  <li>
                    <div>純利益</div>
                    <div>
                      <span>&yen;</span>
                      {{ item.cost | addComma}}
                    </div>
                  </li>
                </ul>
              </v-list-item>
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-expansion-panels>
        <v-divider></v-divider>
        <v-card-actions>
          <v-btn text>
            <fi icon="chart-bar" />統計
          </v-btn>
          <v-btn text @click="showEdit">
            <fi icon="edit" />編集
          </v-btn>
        </v-card-actions>
      </v-card>
    </mq-layout>
    <basic-modal></basic-modal>
  </div>
</template>

<script>
import { mapActions, mapMutations } from "vuex";
import BasicModal from "./BasicModal.vue";
export default {
  components: {
    BasicModal
  },
  filters: {
    addComma: function(value) {
      return value.toLocaleString();
    }
  },
  props: {
    item: {
      type: Object,
      required: true
    }
  },
  computed: {
    imageSrc() {
      return "https://storage.googleapis.com/fremanager-dev/" + this.item.filename;
    }
  },
  methods: {
    showEdit: function() {
      this.$store.dispatch("multiModal/showEditItem", { item: this.item });
    }
  }
};
</script>

<style lang="scss" scoped>
.v-card__actions {
  display: flex;
  justify-content: flex-end;
  & > * {
    color: rgb(0, 192, 182) !important;
    font-size: 16px !important;
  }
  & > button > .v-btn__content {
    line-height: 16px !important;
    & > svg {
      font-size: 16px !important;
      margin-right: 3px;
    }
  }
}
.v-card__title {
  color: rgba(0, 0, 0, 0.6);
  font-size: 24px;
}
.v-list-item__avatar {
  margin-right: 15px;
}
.v-list-item__title {
  font-size: 18px;
}
.v-list-item {
  & ul {
    list-style: none;
    display: flex;
    justify-content: space-between;
    width: 100%;
    & li {
      width: 100%;
      position: relative;
      // margin-right: 40px;
      &:first-child {
        padding-right: 15px;
        & div {
          &:first-child {
            right: 15px;
          }
        }
      }
      & div {
        font-size: 24px;
        &:first-child {
          position: absolute;
          right: 0;
          font-size: 10px;
        }
        &:last-child {
          text-align: right;
          margin-top: 10px;
          display: block;
          font-weight: bold;
          font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
            Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
          color: rgba(228, 122, 60, 0.774);
          & span {
            font-size: 14px;
          }
        }
      }
    }
  }
}
.v-expansion-panel-content {
  & .v-list-item {
    padding: 0 0 3px 0;
  }
}
.v-expansion-panel-header {
  padding: 0 15px 0 0;
}
.v-avatar {
  border-radius: 5px;
  border: 1px solid lightgrey;
}
.v-list-item__title {
  text-align: left;
  white-space: unset;
}
.item-category {
  top: 0;
  position: absolute;
}
</style>
