<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="600px">
      <v-card>
        <v-card-title>
          <span class="headline">編集</span>
        </v-card-title>
        <v-card-text>
          <form class="form" @submit.prevent="submit">
            <v-container>
              <v-row>
                <v-col cols="12" sm="6" md="4">
                  <v-avatar tile size="80" color="grey">
                    <v-img
                      class="white--text align-end"
                      :src="preview"
                    ></v-img>
                  </v-avatar>
                  <input style="display:none" type="file" ref="input" @change="selected"/>
                  <v-btn @click="select">画像を選択</v-btn>
                </v-col>
                <v-col cols="12" sm="6" md="4">
                  <v-text-field label="商品名" required v-model="form.name"></v-text-field>
                </v-col>
              </v-row>
            </v-container>
          </form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="hideModal">取消</v-btn>
          <v-btn color="blue darken-1" text @click="save">保存</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
import Vue from "vue";
import { mapState, mapMutations } from "vuex";
import MultiModalMixin from "../mixins/MultiModalMixin";
export default {
  name: "AddItem",
  mixins: [MultiModalMixin],
  data() {
    return {
      dialog: false,
      form: null,
      preview: "",
      image: null
    };
  },
  computed: {
    ...mapState("multiModal", ["modalName"]),
  },
  created: function() {
    this.dialog = this.modalName == "AddItem";
    this.form = Vue.util.extend({}, this.item);
  },
  methods: {
    select() {
      this.$refs.input.click();
    },
    selected(e) {
      // 何も選択されていなかったら処理中断
      if (event.target.files.length === 0) {
        this.reset()
        return false
      }

      // ファイルが画像ではなかったら処理中断
      if (! event.target.files[0].type.match('image.*')) {
        this.reset()
        return false
      }

      // FileReaderクラスのインスタンスを取得
      const reader = new FileReader()

      // ファイルを読み込み終わったタイミングで実行する処理
      reader.onload = e => {
        // previewに読み込み結果（データURL）を代入する
        // previewに値が入ると<output>につけたv-ifがtrueと判定される
        // また<output>内部の<img>のsrc属性はpreviewの値を参照しているので
        // 結果として画像が表示される
        this.preview = e.target.result
      }

      // ファイルを読み込む
      // 読み込まれたファイルはデータURL形式で受け取れる（上記onload参照）
      reader.readAsDataURL(event.target.files[0])
      console.log(event.target.files[0])
      this.image = event.target.files[0]
    },
    save() {
      this.submit();
      this.hideModal();
    },
    async submit() {
      const formData = new FormData();
      for (var key in this.form) {
        
        console.log(key)
        console.log(this.form[key])
        formData.append(key, this.form[key]);
      }
      if (this.image != null) {
        console.log("appendimage")
        formData.append('image', this.image);
      }
      await this.$store.dispatch("item/addItem", { item: formData });
    }
  }
};
</script>