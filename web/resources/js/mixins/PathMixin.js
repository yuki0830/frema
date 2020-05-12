import { mapState } from 'vuex'
export default {
  computed: {
    ...mapState("path", ["path"]),
  },
  created: function() {
    this.$store.dispatch("path/setPath", { path: this.$route.path });
  }
}