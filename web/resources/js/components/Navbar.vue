<template>
  <nav class="navbar">
    <mq-layout mq="lg">
      <RouterLink class="navbar__brand" to="/">Vuesplash LG</RouterLink>
      <div class="navbar__menu">
        <div v-if="isLogin" class="navbar__item">
          <button class="button" @click="showForm = ! showForm">
            <i class="icon ion-md-add"></i>
            Submit a photo
          </button>
        </div>
        <span v-if="isLogin" class="navbar__item">{{ username }}</span>
        <div v-else class="navbar__item">
          <RouterLink class="button button--link" to="/login">Login / Register</RouterLink>
        </div>
      </div>
      <PhotoForm v-model="showForm" />
    </mq-layout>
    <mq-layout mq="md">
      <RouterLink class="navbar__brand" to="/">Vuesplash MD</RouterLink>
      <div class="navbar__menu">
        <div v-if="isLogin" class="navbar__item">
          <button class="button" @click="showForm = ! showForm">
            <i class="icon ion-md-add"></i>
            Submit a photo
          </button>
        </div>
        <span v-if="isLogin" class="navbar__item">{{ username }}</span>
        <div v-else class="navbar__item">
          <RouterLink class="button button--link" to="/login">Login / Register</RouterLink>
        </div>
      </div>
      <PhotoForm v-model="showForm" />
    </mq-layout>
    <mq-layout mq="sm">
      <RouterLink class="navbar__brand" to="/">FREMNGR</RouterLink>
      <div class="navbar__menu">
        <div v-if="isLogin" class="navbar__item">
          <button class="button" @click="showForm = ! showForm">
            <i class="icon ion-md-add"></i>
            Submit a photo
          </button>
        </div>
        <span v-if="isLogin" class="navbar__item">{{ username }}</span>
        <div v-else class="navbar__item">
          <RouterLink class="button button--link" to="/login">Login / Register</RouterLink>
        </div>
      </div>
      <PhotoForm v-model="showForm" />
      <v-btn absolute dark fab bottom right color="pink" @click="openModal">
        <fi :icon="icon" />
      </v-btn>
    </mq-layout>
  </nav>
</template>

<script>
import { mapState } from 'vuex'
import PhotoForm from "./PhotoForm.vue";
import consts from '../consts'
export default {
  components: {
    PhotoForm
  },
  data() {
    return {
      showForm: false
    };
  },
  computed: {
    ...mapState("path", ["path"]),
    isLogin() {
      return this.$store.getters["auth/check"];
    },
    username() {
      return this.$store.getters["auth/username"];
    },
    icon() {
      return this.$store.getters["path/floatButton"];
    }
  },
  methods: {
    openModal: function() {
      switch (this.path) {
        case consts.Pages.HOME:
          this.$store.dispatch("multiModal/showAddItem");
          break;
        default:
          console.log("adfafad");
      }
    },
  }
};
</script>

<style lang="scss" scoped>
.navbar__brand {
  color: white !important;
}
</style>
