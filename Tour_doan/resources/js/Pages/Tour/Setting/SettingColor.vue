<template>
  <section class="content">
      <Head title="Setting Color"></Head>
    <ContentHeaderVue :name="'Setting Color'" :icon="'fa fa-cog'" />
    <alert :dismissible="true"></alert>
    <BreadCrumb :crumbs="crumbs" />
    <form @submit.prevent="save">
      <div class="row">
        <div class="col-md-12">
          <!-- <div class="col-md-3">
            <label
              class="block tracking-wide text-gray-700 text-2xl font-bold mb-2"
              for="grid-last-name"
            >Icon Color</label>
            <div class="one-colorpicker" ref="colorpicker">
              <div
                id="icon_color"
                class="color-block rounded-full"
                :style="{ backgroundColor: form.icon_color }"
                @click="toggle($event)"
              >
                <div class="color-block-layer value" :style="{ backgroundColor:  form.icon_color }"></div>
                <div class="color-block-layer bg"></div>
              </div>
              <color-panel class="color-panel" id="icon_color_1" v-model="form.icon_color"></color-panel>
            </div>
            <p class="text-red-500 text-xs italic" v-if="errors.icon_color">{{ errors.icon_color }}</p>
          </div>

          <div class="col-md-3">
            <label
              class="block tracking-wide text-gray-700 text-2xl font-bold mb-2"
              for="grid-last-name"
            >BackGround Color Icon</label>
            <div class="one-colorpicker" ref="colorpicker">
              <div
                id="bg_icon_color"
                class="color-block rounded-full"
                :style="{ backgroundColor: form.bg_icon_color }"
                @click="toggle($event)"
              >
                <div
                  class="color-block-layer value"
                  :style="{ backgroundColor:  form.bg_icon_color }"
                ></div>
                <div class="color-block-layer bg"></div>
              </div>
              <color-panel class="color-panel" id="bg_icon_color_1" v-model="form.bg_icon_color"></color-panel>
            </div>
            <p
              class="text-red-500 text-xs italic"
              v-if="errors.bg_icon_color"
            >{{ errors.bg_icon_color }}</p>
          </div> -->

          <div class="col-md-3">
            <label
              class="block tracking-wide text-gray-700 text-2xl font-bold mb-2"
              for="grid-last-name"
            >Hover Icon Color</label>
            <div class="one-colorpicker" ref="colorpicker">
              <div
                id="hover_color_icon"
                class="color-block rounded-full"
                :style="{ backgroundColor: form.hover_color_icon }"
                @click="toggle($event)"
              >
                <div
                  class="color-block-layer value"
                  :style="{ backgroundColor:  form.hover_color_icon }"
                ></div>
                <div class="color-block-layer bg"></div>
              </div>
              <color-panel class="color-panel" id="hover_color_icon_1" v-model="form.hover_color_icon"></color-panel>
            </div>
            <p
              class="text-red-500 text-xs italic"
              v-if="errors.hover_color_icon"
            >{{ errors.hover_color_icon }}</p>
          </div>

          <div class="col-md-3">
            <label
              class="block tracking-wide text-gray-700 text-2xl font-bold mb-2"
              for="grid-last-name"
            >Hover BackGround Icon Color</label>
            <div class="one-colorpicker" ref="colorpicker">
              <div
                id="hover_bg_icon_color"
                class="color-block rounded-full"
                :style="{ backgroundColor: form.hover_bg_icon_color }"
                @click="toggle($event)"
              >
                <div
                  class="color-block-layer value"
                  :style="{ backgroundColor:  form.hover_bg_icon_color }"
                ></div>
                <div class="color-block-layer bg"></div>
              </div>
              <color-panel
                class="color-panel"
                id="hover_bg_icon_color_1"
                v-model="form.hover_bg_icon_color"
              ></color-panel>
            </div>
            <p
              class="text-red-500 text-xs italic"
              v-if="errors.hover_bg_icon_color"
            >{{ errors.hover_bg_icon_color }}</p>
          </div>

            <div class="col-md-3">
            <label
              class="block tracking-wide text-gray-700 text-2xl font-bold mb-2"
              for="grid-last-name"
            >Active Icon Color</label>
            <div class="one-colorpicker" ref="colorpicker">
              <div
                id="active_icon_color"
                class="color-block rounded-full"
                :style="{ backgroundColor: form.active_icon_color }"
                @click="toggle($event)"
              >
                <div class="color-block-layer value" :style="{ backgroundColor:  form.active_icon_color }"></div>
                <div class="color-block-layer bg"></div>
              </div>
              <color-panel class="color-panel" id="active_icon_color_1" v-model="form.active_icon_color"></color-panel>
            </div>
            <p class="text-red-500 text-xs italic" v-if="errors.active_icon_color">{{ errors.active_icon_color }}</p>
          </div>

          <div class="col-md-3">
            <label
              class="block tracking-wide text-gray-700 text-2xl font-bold mb-2"
              for="grid-last-name"
            >Active  Background icon Color</label>
            <div class="one-colorpicker" ref="colorpicker">
              <div
                id="active_bg_icon_color"
                class="color-block rounded-full"
                :style="{ backgroundColor: form.active_bg_icon_color }"
                @click="toggle($event)"
              >
                <div
                  class="color-block-layer value"
                  :style="{ backgroundColor:  form.active_bg_icon_color }"
                ></div>
                <div class="color-block-layer bg"></div>
              </div>
              <color-panel class="color-panel" id="active_bg_icon_color_1" v-model="form.active_bg_icon_color"></color-panel>
            </div>
            <p
              class="text-red-500 text-xs italic"
              v-if="errors.active_bg_icon_color"
            >{{ errors.active_bg_icon_color }}</p>
          </div>

          <div class="col-md-3">
            <label
              class="block tracking-wide text-gray-700 text-2xl font-bold mb-2"
              for="grid-last-name"
            >BackGround Menu Color</label>
            <div class="one-colorpicker" ref="colorpicker">
              <div
                id="bg_menu_color"
                class="color-block rounded-full"
                :style="{ backgroundColor: form.bg_menu_color }"
                @click="toggle($event)"
              >
                <div
                  class="color-block-layer value"
                  :style="{ backgroundColor:  form.bg_menu_color }"
                ></div>
                <div class="color-block-layer bg"></div>
              </div>
              <color-panel class="color-panel" id="bg_menu_color_1" v-model="form.bg_menu_color"></color-panel>
            </div>
            <p
              class="text-red-500 text-xs italic"
              v-if="errors.bg_menu_color"
            >{{ errors.bg_menu_color }}</p>
          </div>

          <div class="col-md-3">
            <label
              class="block tracking-wide text-gray-700 text-2xl font-bold mb-2"
              for="grid-last-name"
            > BackGround Category Color</label>
            <div class="one-colorpicker" ref="colorpicker">
              <div
                id="bg_color_category"
                class="color-block rounded-full"
                :style="{ backgroundColor: form.bg_color_category }"
                @click="toggle($event)"
              >
                <div
                  class="color-block-layer value"
                  :style="{ backgroundColor:  form.bg_color_category }"
                ></div>
                <div class="color-block-layer bg"></div>
              </div>
              <color-panel
                class="color-panel"
                id="bg_color_category_1"
                v-model="form.bg_color_category"
              ></color-panel>
            </div>
            <p
              class="text-red-500 text-xs italic"
              v-if="errors.bg_color_category"
            >{{ errors.bg_color_category }}</p>
          </div>

            <div class="col-md-3">
            <label
              class="block tracking-wide text-gray-700 text-2xl font-bold mb-2"
              for="grid-last-name"
            >Color Category</label>
            <div class="one-colorpicker" ref="colorpicker">
              <div
                id="color_category"
                class="color-block rounded-full"
                :style="{ backgroundColor: form.color_category }"
                @click="toggle($event)"
              >
                <div class="color-block-layer value" :style="{ backgroundColor:  form.color_category }"></div>
                <div class="color-block-layer bg"></div>
              </div>
              <color-panel class="color-panel" id="color_category_1" v-model="form.color_category"></color-panel>
            </div>
            <p class="text-red-500 text-xs italic" v-if="errors.color_category">{{ errors.color_category }}</p>
          </div>

          <div class="col-md-3">
            <label
              class="block tracking-wide text-gray-700 text-2xl font-bold mb-2"
              for="grid-last-name"
            > Color Item</label>
            <div class="one-colorpicker" ref="colorpicker">
              <div
                id="color_item"
                class="color-block rounded-full"
                :style="{ backgroundColor: form.color_item }"
                @click="toggle($event)"
              >
                <div
                  class="color-block-layer value"
                  :style="{ backgroundColor:  form.color_item }"
                ></div>
                <div class="color-block-layer bg"></div>
              </div>
              <color-panel class="color-panel" id="color_item_1" v-model="form.color_item"></color-panel>
            </div>
            <p
              class="text-red-500 text-xs italic"
              v-if="errors.color_item"
            >{{ errors.color_item }}</p>
          </div>

          <div class="col-md-3">
            <label
              class="block tracking-wide text-gray-700 text-2xl font-bold mb-2"
              for="grid-last-name"
            >Hover Item Colors</label>
            <div class="one-colorpicker" ref="colorpicker">
              <div
                id="hover_color_item"
                class="color-block rounded-full"
                :style="{ backgroundColor: form.hover_color_item }"
                @click="toggle($event)"
              >
                <div
                  class="color-block-layer value"
                  :style="{ backgroundColor:  form.hover_color_item }"
                ></div>
                <div class="color-block-layer bg"></div>
              </div>
              <color-panel class="color-panel" id="hover_color_item_1" v-model="form.hover_color_item"></color-panel>
            </div>
            <p
              class="text-red-500 text-xs italic"
              v-if="errors.hover_color_item"
            >{{ errors.hover_color_item }}</p>
          </div>

          <div class="col-md-3">
            <label
              class="block tracking-wide text-gray-700 text-2xl font-bold mb-2"
              for="grid-last-name"
            >Active Color Item</label>
            <div class="one-colorpicker" ref="colorpicker">
              <div
                id="active_color_item"
                class="color-block rounded-full"
                :style="{ backgroundColor: form.active_color_item }"
                @click="toggle($event)"
              >
                <div
                  class="color-block-layer value"
                  :style="{ backgroundColor:  form.active_color_item }"
                ></div>
                <div class="color-block-layer bg"></div>
              </div>
              <color-panel
                class="color-panel"
                id="active_color_item_1"
                v-model="form.active_color_item"
              ></color-panel>
            </div>
            <p
              class="text-red-500 text-xs italic"
              v-if="errors.active_color_item"
            >{{ errors.active_color_item }}</p>
          </div>
        </div>
          <div
                  class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b"
                >
                  <button
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-grat-300 font-medium rounded-lg text-2xl px-4 py-2.5 mr-1 mb-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="submit"
                    @click.prevent="save"
                  >{{ __("Update") }}</button>
          </div>
      </div>

      <div class="row color_setting">
        <div class="row-item col-md-12">
            <div class="item col-4">
            <h2 class="font-bold text-5xl">Color Icon</h2>
                <div class="item-row">
                    <label class="block tracking-wide text-gray-400 mb-2"
                    for="grid-last-name"> Icon Color </label>
                    <div class="one-colorpicker" ref="colorpicker">
                        <div
                            id="icon_color"
                            class="color-block rounded-full"
                            :style="{ backgroundColor: form.icon_color }"
                            @click="toggle($event)"
                        >
                            <div class="color-block-layer value" :style="{ backgroundColor:  form.icon_color }"></div>
                            <div class="color-block-layer bg"></div>
                        </div>
                        <div class="text-color p-2">{{ form.icon_color }}</div>
                        <color-panel class="color-panel" id="icon_color_1" v-model="form.icon_color"></color-panel>
                    </div>
                    <p class="text-red-500 text-xs italic" v-if="errors.icon_color">{{ errors.icon_color }}</p>
                </div>
                <div class="item-row">
                    <label
                        class="block tracking-wide text-gray-400  mb-2"
                        for="grid-last-name"
                        >BackGround Icon Color</label>
                        <div class="one-colorpicker" ref="colorpicker">
                            <div
                                id="bg_icon_color"
                                class="color-block rounded-full"
                                :style="{ backgroundColor: form.bg_icon_color }"
                                @click="toggle($event)"
                            >

                                <div
                                class="color-block-layer value"
                                :style="{ backgroundColor:  form.bg_icon_color }"
                                ></div>
                                <div class="color-block-layer bg"></div>
                            </div>
                            <div class="text-color p-2">{{ form.icon_color }}</div>
                            <color-panel class="color-panel" id="bg_icon_color_1" v-model="form.bg_icon_color"></color-panel>
                        </div>
                        <p
                        class="text-red-500 text-xs italic"
                        v-if="errors.bg_icon_color"
                        >{{ errors.bg_icon_color }}</p>
                </div>
                <div class="item-row">
                    <label
                        class="block tracking-wide text-gray-400  mb-2"
                        for="grid-last-name"
                        >Hover Icon Color</label>
                        <div class="one-colorpicker" ref="colorpicker">
                        <div
                            id="hover_color_icon"
                            class="color-block rounded-full"
                            :style="{ backgroundColor: form.hover_color_icon }"
                            @click="toggle($event)"
                        >
                            <div
                            class="color-block-layer value"
                            :style="{ backgroundColor:  form.hover_color_icon }"
                            ></div>
                            <div class="color-block-layer bg"></div>
                        </div>
                        <div class="text-color p-2">{{ form.icon_color }}</div>
                        <color-panel class="color-panel" id="hover_color_icon_1" v-model="form.hover_color_icon"></color-panel>
                        </div>
                        <p
                        class="text-red-500 text-xs italic"
                        v-if="errors.hover_color_icon"
                        >{{ errors.hover_color_icon }}</p>
                            </div>
            </div>
        </div>


      </div>
    </form>
  </section>
</template>

<script>
import { Link,Head } from "@inertiajs/inertia-vue";
import ContentHeaderVue from "@/Components/Layout/ContentHeader";
import Pagination from "@/Components/Pagination";
import Alert from "@/Components/Alert";
import Layout from "@/Pages/Tour/LayoutSetting";
import BreadCrumb from "@/Pages/Tour/BreadCrumb";
export default {
  layout: Layout,
  components: {
    Link,
    ContentHeaderVue,
    Pagination,
    Alert,
    BreadCrumb,
    Head
  },
  props: {
    tour: Object,
    setting_color: Object,
    errors: Object
  },
  data() {
    return {
      form: this.$inertia.form({
        icon_color: this.setting_color ? this.setting_color.icon_color : null,
        bg_icon_color: this.setting_color
          ? this.setting_color.bg_icon_color
          : null,
        hover_color_icon: this.setting_color
          ? this.setting_color.hover_color_icon
          : null,
        hover_bg_icon_color: this.setting_color
          ? this.setting_color.hover_bg_icon_color
          : null,
        active_icon_color: this.setting_color
          ? this.setting_color.active_icon_color
          : null,
        active_bg_icon_color: this.setting_color
          ? this.setting_color.active_bg_icon_color
          : null,
        bg_menu_color: this.setting_color
          ? this.setting_color.bg_menu_color
          : null,
        bg_color_category: this.setting_color
          ? this.setting_color.bg_color_category
          : null,
        color_category: this.setting_color
          ? this.setting_color.color_category
          : null,
        color_item: this.setting_color ? this.setting_color.color_item : null,
        hover_color_item: this.setting_color
          ? this.setting_color.hover_color_item
          : null,
        active_color_item: this.setting_color
          ? this.setting_color.active_color_item
          : null
      }),
      crumbs: [
        {
          route: "tour.index",
          parma: null,
          name: "Tour"
        },
        {
          route: "tour.index",
          parma: null,
          name: this.tour.name
        },
        {
          route: "tour.setting-color.index",
          parma: this.tour.id,
          name: "Setting Color"
        }
      ]
    };
  },
  methods: {
    changeColor(color) {
      const { r, g, b, a } = color.rgba;
      this.formData.color_bg = `rgba(${r}, ${g}, ${b}, ${a})`;
    },
    toggle(event) {
      var targetId = event.currentTarget.id;
      console.log(targetId); // returns 'foo'

      $(`#${targetId}_1`).toggle();
    },
     save() {
      this.form.post(
        this.route("tour.setting-color.store", this.tour.id),
        {
          preserveState: false
        }
      );
    },
  }
};
</script>

<style scoped>
.color-block {
  width: 20px;
  height: 20px;
  background-color: #b87823;
  z-index: 1000;
  border: 2px solid;
}
.color-panel {
  display: none;
}
.one-colorpicker{
    display: flex;
}
</style>
