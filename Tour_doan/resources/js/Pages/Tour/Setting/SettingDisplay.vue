<template>
  <div class="content">
    <Head title="Setting Display"></Head>
    <ContentHeaderVue :name="'Setting Display'" :icon="'fa fa-cog'" />
    <alert :dismissible="true"></alert>
    <BreadCrumb :crumbs="crumbs" />
 
      <div class="col-sm-12 col-md-6 col-lg-8">
        <form @submit.prevent="save" class="form-group">
          <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="relative block my-4">
                <input
                  v-model="form.sound"
                  :checked="setting_display && setting_display.sound == 1 ? true : false"
                  class="toggle-class-public form-radio rounded-md h-10 w-10 text-indigo-600"
                  type="checkbox"
                />
                <label for="checkboxThreeInput">{{ __('sound') }}</label>
              </div>
              <div class="relative block my-4">
                <input
                  v-model="form.share"
                  :checked="setting_display && setting_display.share == 1 ? true : false"
                  class="toggle-class-public form-radio rounded-md h-10 w-10 text-indigo-600"
                  type="checkbox"
                />
                <label for="checkboxThreeInput">{{ __('share') }}</label>
              </div>

              <div class="relative block my-4">
                <input
                  v-model="form.back_scene"
                  :checked="setting_display && setting_display.back_scene == 1 ? true : false"
                  class="toggle-class-public form-radio rounded-md h-10 w-10 text-indigo-600"
                  type="checkbox"
                />
                <label for="checkboxThreeInput">{{ __('back_scene') }}</label>
              </div>


              <!-- <div class="relative block my-4">
                <input
                  v-model="form.back_scene"
                  :checked="setting_display && setting_display.back_scene == 1 ? true : false"
                  class="toggle-class-public form-radio rounded-md h-10 w-10 text-indigo-600"
                  type="checkbox"
                />
                <label for="checkboxThreeInput">{{ __('back_scene') }}</label>
              </div> -->
              <div class="relative block my-4">
                <input
                  v-model="form.fullscreen"
                  :checked="setting_display && setting_display.fullscreen == 1 ? true : false"
                  class="toggle-class-public form-radio rounded-md h-10 w-10 text-indigo-600"
                  type="checkbox"
                />
                <label for="checkboxThreeInput">{{ __('fullscreen') }}</label>
              </div>
              <div class="relative block my-4">
                <input
                  v-model="form.infor"
                  :checked="setting_display && setting_display.infor == 1 ? true : false"
                  class="toggle-class-public form-radio rounded-md h-10 w-10 text-indigo-600"
                  type="checkbox"
                />
                <label for="checkboxThreeInput">{{ __('infor') }}</label>
              </div>
              <div class="relative block my-4">
                <input
                  v-model="form.setting_map"
                  :checked="setting_display && setting_display.setting_map == 1 ? true : false"
                  class="toggle-class-public form-radio rounded-md h-10 w-10 text-indigo-600"
                  type="checkbox"
                />
                <label for="checkboxThreeInput">{{ __('Map') }}</label>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="relative block my-4">
                <input
                  v-model="form.guide"
                  :checked="setting_display && setting_display.guide == 1 ? true : false"
                  class="toggle-class-public form-radio rounded-md h-10 w-10 text-indigo-600"
                  type="checkbox"
                />
                <label for="checkboxThreeInput">{{ __('guide') }}</label>
              </div>
              <div class="relative block my-4">
                <input
                  v-model="form.show_hotspot"
                  :checked="setting_display && setting_display.show_hotspot == 1 ? true : false"
                  class="toggle-class-public form-radio rounded-md h-10 w-10 text-indigo-600"
                  type="checkbox"
                />
                <label for="checkboxThreeInput">{{ __('show Hotspot') }}</label>
              </div>
              <div class="relative block my-4">
                <input
                  v-model="form.setting_vr"
                  :checked="setting_display && setting_display.setting_vr == 1 ? true : false"
                  class="toggle-class-public form-radio rounded-md h-10 w-10 text-indigo-600"
                  type="checkbox"
                />
                <label for="checkboxThreeInput">{{ __('Setting VR') }}</label>
              </div>
              <div class="relative block my-4">
                <input
                  v-model="form.contact"
                  :checked="setting_display && setting_display.contact == 1 ? true : false"
                  class="toggle-class-public form-radio rounded-md h-10 w-10 text-indigo-600"
                  type="checkbox"
                />
                <label for="checkboxThreeInput">{{ __('contact') }}</label>
              </div>
              <div class="relative block my-4">
                <input
                  v-model="form.rotate"
                  :checked="setting_display && setting_display.rotate == 1 ? true : false"
                  class="toggle-class-public form-radio rounded-md h-10 w-10 text-indigo-600"
                  type="checkbox"
                />
                <label for="checkboxThreeInput">{{ __('Rotate') }}</label>
              </div>
            </div>
          </div>
          <div class="flex items-center justify-end p-6 ">
            <button
              @click.prevent="save()"
              type="submit"
              class="inline-block px-6 py-2.5 bg-gray-800 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out"
            >Save changes</button>
          </div>
        </form>
      </div>
   
  </div>
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
    errors: Object,
    setting_display: Object
  },
  data() {
    return {
      term: null,
      editMode: false,
      form: this.$inertia.form({
        id: null,
        sound:
          this.setting_display && this.setting_display.sound
            ? this.setting_display.sound
            : false,
        share:
          this.setting_display && this.setting_display.share
            ? this.setting_display.share
            : false,
        back_scene:
          this.setting_display && this.setting_display.back_scene
            ? this.setting_display.back_scene
            : false,
        fullscreen:
          this.setting_display && this.setting_display.fullscreen
            ? this.setting_display.fullscreen
            : false,
        infor:
          this.setting_display && this.setting_display.infor
            ? this.setting_display.infor
            : false,
        setting_map:
          this.setting_display && this.setting_display.setting_map
            ? this.setting_display.setting_map
            : false,
        guide:
          this.setting_display && this.setting_display.guide
            ? this.setting_display.guide
            : false,
        show_hotspot:
          this.setting_display && this.setting_display.show_hotspot
            ? this.setting_display.show_hotspot
            : false,
        setting_vr:
          this.setting_display && this.setting_display.setting_vr
            ? this.setting_display.setting_vr
            : false,
        contact:
          this.setting_display && this.setting_display.contact
            ? this.setting_display.contact
            : false,
        rotate: this.setting_display && this.setting_display.rotate
            ? this.setting_display.rotate
            : false,

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
          route: "tour.setting-display.index",
          parma: this.tour.id,
          name: "Setting Display"
        }
      ]
    };
  },
  methods: {
    reset() {
      this.form = this.$inertia.form({
        sound:
          this.setting_display && this.setting_display.sound
            ? this.setting_display.sound
            : false,
        share:
          this.setting_display && this.setting_display.share
            ? this.setting_display.share
            : false,
        fullscreen:
          this.setting_display && this.setting_display.fullscreen
            ? this.setting_display.fullscreen
            : false,
        infor:
          this.setting_display && this.setting_display.infor
            ? this.setting_display.infor
            : false,
        setting_map:
          this.setting_display && this.setting_display.setting_map
            ? this.setting_display.setting_map
            : false,
        guide:
          this.setting_display && this.setting_display.guide
            ? this.setting_display.guide
            : false,
        show_hotspot:
          this.setting_display && this.setting_display.show_hotspot
            ? this.setting_display.show_hotspot
            : false,
        setting_vr:
          this.setting_display && this.setting_display.setting_vr
            ? this.setting_display.setting_vr
            : false,
        contact:
          this.setting_display && this.setting_display.contact
            ? this.setting_display.contact
            : false,
        rotate: this.setting_display && this.setting_display.rotate
        ? this.setting_display.rotate
        : false,
      });
    },
    save() {
      this.form.post(this.route("tour.setting-display.store", this.tour.id), {
        preserveState: false
      });
    }
  }
};
</script>

<style>
.content{
  min-height: 100%;
}
</style>