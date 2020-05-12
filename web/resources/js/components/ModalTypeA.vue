<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="290">
      <v-card>
        <v-card-title class="headline">Use Google's location service?</v-card-title>
        <v-card-text>Let Google help apps determine location. This means sending anonymous location data to Google, even when no apps are running.</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green" text @click="hideModal">Disagree</v-btn>
          <v-btn color="green" text @click="hideModal">Agree</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
import { mapState, mapMutations } from "vuex";
import MultiModalMixin from "../mixins/MultiModalMixin";
export default {
  name: "ModalTypeA",
  mixins: [MultiModalMixin],
  data() {
    return {
      dialog: false
    };
  },
  computed: {
    ...mapState("multiModal", ["modalName"]),
  },
  created: function() {
      console.log(this.dialog);
      this.dialog = this.modalName == "ModalTypeA";
      console.log(this.dialog);
  }
};
</script>