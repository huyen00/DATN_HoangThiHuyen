<template>
  <div class="mt-10 sm:mt-0 overflow-auto">
  
    <h1>{{__('create')}}</h1>
    <BreadCrumb :crumbs="crumbs" />
    <div class="mt-5 md:mt-0 md:col-span-3">
      <form @submit.prevent="save">
        <div class="shadow overflow-hidden sm:rounded-md">
          <div class="px-4 py-5 bg-white sm:p-6">
            <div class="grid gap-4">
              <div class="col-span-6 sm:col-span-3">
                <label
                  for="email_address"
                  class="block text-xl font-medium text-gray-700"
                >{{__('title')}} {{__('en')}}</label>
                <input
                  v-model="form.title_en"
                  type="text"
                  name="email_address"
                  id="email_address"
                  autocomplete="email"
                  placeholder="Title English"
                  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-xl border-gray-300 rounded-md"
                />
                <div class="text-red-500" v-if="errors.title_en">{{ errors.title_en }}</div>
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label
                  for="country"
                  class="block text-xl font-medium text-gray-700"
                >{{__('title')}} {{__('vn')}}</label>
                <input
                  v-model="form.title_vn"
                  type="text"
                  name="email_address"
                  id="email_address"
                  placeholder="Title VietNamese"
                  autocomplete="email"
                  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-xl border-gray-300 rounded-md"
                />
                <div class="text-red-500" v-if="errors.title_vn">{{ errors.title_vn }}</div>
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label
                  for="email_address"
                  class="block text-xl font-medium text-gray-700"
                >{{__('sub_title')}} {{__('en')}}</label>
                <input
                  v-model="form.sub_title_en"
                  type="text"
                  name="email_address"
                  id="email_address"
                  autocomplete="email"
                  placeholder="Title English"
                  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-xl border-gray-300 rounded-md"
                />
                <div class="text-red-500" v-if="errors.sub_title_en">{{ errors.sub_title_en }}</div>
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label
                  for="country"
                  class="block text-xl font-medium text-gray-700"
                >{{__('sub_title')}} {{__('vn')}}</label>
                <input
                  v-model="form.sub_title_vn"
                  type="text"
                  name="email_address"
                  id="email_address"
                  placeholder="Title VietNamese"
                  autocomplete="email"
                  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-xl border-gray-300 rounded-md"
                />
                <div class="text-red-500" v-if="errors.sub_title_vn">{{ errors.sub_title_vn }}</div>
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label
                  for="street_address"
                  class="block text-xl font-medium text-gray-700"
                >{{__('description')}} {{__('en')}}</label>
                <div class="mt-1">
                  <ckeditor
                    v-model="form.description_en"
                    :config="editorConfig"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-xl border-gray-300 rounded-md"
                    placeholder="Description VietNamese"
                  ></ckeditor>
                  <!-- <textarea
                    v-model="form.description_en"
                    id="about"
                    name="about"
                    rows="3"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-xl border-gray-300 rounded-md"
                    placeholder="Description English"
                  ></textarea>-->
                </div>
                <div class="text-red-500" v-if="errors.description_en">{{ errors.description_en }}</div>
              </div>
              <div class="col-span-6 sm:col-span-3">
                <label
                  for="street_address"
                  class="block text-xl font-medium text-gray-700"
                >{{__('description')}} {{__('vn')}}</label>
                <div class="mt-1">
                  <ckeditor
                    v-model="form.description_vn"
                    :config="editorConfig2"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-xl border-gray-300 rounded-md"
                    placeholder="Description VietNamese"
                  ></ckeditor>
                  <!-- <textarea
                    v-model="form.description_vn"
                    id="about"
                    name="about"
                    rows="3"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-xl border-gray-300 rounded-md"
                    placeholder="Description VietNamese"
                  ></textarea>-->
                </div>
                <div class="text-red-500" v-if="errors.description_vn">{{ errors.description_vn }}</div>
              </div>
              <div class="col-span-6">
                <label
                  for="street_address"
                  class="block text-xl font-medium text-gray-700"
                >Choose Theme</label>
                <div class="mt-5">
                  <div class="flex flex-wrap">
                    <div v-for="(theme,index) in themes" :key="index" class="flex items-center">
                      <input
                        type="radio"
                        v-model="form.theme_id"
                        name="inlineRadioOptions"
                        id="inlineRadio1"
                        :value="theme.id"
                        class="form-check-input form-check-input ml-2 appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                      />
                      <div class="ml-2 text-xl">
                        <span
                          for="helper-checkbox"
                          class="font-medium text-gray-900 dark:text-gray-300"
                        ></span>
                      </div>
                      <div class="ml-2 text-xl mt-4">
                        <span
                          v-if="theme.type ==0"
                          class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-600 text-white rounded"
                        >No Category Content</span>
                        <span
                          v-else-if="theme.type ==1"
                          class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-600 text-white rounded"
                        >Category Content</span>
                        <span
                          v-else-if="theme.type ==2"
                          class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-blue-600 text-white rounded"
                        >Blog (No Category )</span>
                        <span
                          v-else-if="theme.type ==3"
                          class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-600 text-white rounded"
                        >Blog (Category )</span>
                        <img
                          :src="theme.image_template"
                          width="200px"
                          id="helper-checkbox-text"
                          class="max-w-full h-auto rounded-lg"
                        />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="text-red-500" v-if="errors.theme_id">{{ errors.theme_id }}</div>
              </div>
            </div>
          </div>
          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <Link
              :href="route('section.index',page.id)"
              class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-xl font-medium rounded-md text-gray-800 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
            >Back</Link>
            <button
              type="submit"
              class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-xl font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import ContentHeaderVue from "@/Components/Layout/ContentHeader";
import Alert from "@/Components/Alert";
import Icon from "@/Components/Icon";
import Layout from "@/Components/Layout/Layout";
import { Link } from "@inertiajs/inertia-vue";
import BreadCrumb from "@/Pages/Tour/BreadCrumb";

export default {
  layout: Layout,
  props: {
    errors: Object,
    page: Object,
    themes: Array
  },
  components: {
    Icon,
    Notification,
    Link,
    BreadCrumb,
    ContentHeaderVue,
    Alert
  },
  data() {
    return {
      editorData: "<p>Content of the editor.</p>",
      editorConfig: {
        // The configuration of the editor.
      },
      editorConfig2: {
        // The configuration of the editor.
      },
      form: this.$inertia.form({
        id: null,
        title: null,
        title_en: null,
        title_vn: null,
        sub_title: null,
        sub_title_en: null,
        sub_title_vn: null,
        description: null,
        description_en: null,
        description_vn: null,
        theme_id: null
      }),
      crumbs: [
        {
          route: "pages",
          parma: null,
          name: "Page"
        },
        {
          route: "section.index",
          parma: this.page.id,
          name: "Sections"
        },
        {
          route: "section.index",
          parma: this.page.id,
          name: "Create"
        }
      ]
    };
  },

  methods: {
    edit: function(data) {
      this.form.id = data.id;
      const result = data.languages.find(element => element.key == data.title);
      const result2 = data.languages.find(
        element => element.key == data.description
      );
      this.form.title_en = result.en;
      this.form.title_vn = result.vn;
      this.form.description = data.description;
      this.form.description_en = result2 == undefined ? null : result2.en;
      this.form.description_vn = result2 == undefined ? null : result2.vn;
      this.from.theme_id = data.theme_id;
      this.toggleModal();
    },

    save() {
      this.form.post(this.route("section.store", this.page.id), {
        preserveState: true,

        onError: errors => {
          if (Object.keys(errors).length > 0) {
          }
        },
        onSuccess: page => {
          this.reset();
        }
      });
    },
    reset: function() {
      this.form = this.$inertia.form({
        id: null,
        title: null,
        description: null,
        title_en: null,
        title_vn: null,
        description_en: null,
        description_vn: null,
        theme_id: null
        // audio360: null
      });
    }
    // update() {
    //   this.form.put(this.route("section.update", this.form.id), {
    //     preserveState: true,
    //     onError: errors => {
    //       if (Object.keys(errors).length > 0) {
    //         this.showModal = true;
    //         this.editMode = true;
    //       }
    //     },
    //     onSuccess: page => {
    //       this.showModal = false;
    //       this.editMode = false;
    //       this.reset();
    //     }
    //   });
    // }
  }
};
</script>
<style scoped>
</style>