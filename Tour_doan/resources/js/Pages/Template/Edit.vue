<template>
  <section class="content">
    <Head title="Template" />
    <ContentHeaderVue :name="'Template'" />
    <alert :dismissible="true"></alert>
    <BreadCrumb :crumbs="crumbs" />
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="mt-4 md:mt-0 md:col-span-1">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Preview</h3>
        <div class="flex flex-wrap justify-center">
          <div class="w-full h-full px-4">
            <img
              v-if="template"
              :src="template.image"
              alt="..."
              class="shadow rounded max-w-full h-auto align-middle border-none"
            />
          </div>
        </div>
      </div>
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent="update">
          <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="form-group" :class="errors.name ? 'is-valid' :''">
              <label for="nameTour" class="col-form-label">Name:</label>
              <input
                type="text"
                class="form-control text-xl"
                :class="errors.name ? 'border-red-500' :''"
                v-model="form.name"
                id="nameTour"
              />
              <div class="text-red-500" v-if="errors.name">{{ errors.name }}</div>
            </div>
            <div class="form-group" :class="errors.link_code ? 'is-valid' :''">
              <label class="col-form-label">Link Code:</label>
              <input
                type="text"
                class="form-control text-xl"
                :class="errors.link_code ? 'border-red-500' :''"
                v-model="form.link_code"
              />
              <div class="text-red-500" v-if="errors.link_code">{{ errors.link_code }}</div>
            </div>
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <div>
                <label class="block text-sm font-medium text-gray-700">Cover photo</label>
                <div
                  class="relative h-40 rounded-lg border-dashed border-2 border-gray-200 bg-white flex justify-center items-center hover:cursor-pointer"
                >
                  <div class="flex flex-wrap justify-center">
                    <div class="w-full h-full px-4">
                      <img
                        v-if="thumb"
                        :src="thumb"
                        alt="..."
                        class="shadow rounded max-w-full h-auto align-middle border-none"
                      />
                    </div>
                  </div>
                  <div class="absolute">
                    <div class="flex flex-col items-center">
                      <i class="fa fa-cloud-upload fa-3x text-gray-200"></i>
                      <span class="block text-gray-400 font-normal">Drag file here</span>
                      <span class="block text-gray-400 font-normal">or</span>
                      <span class="block text-blue-400 font-normal">Browse files</span>
                    </div>
                  </div>

                  <input
                    @change="onFileChange"
                    type="file"
                    class="h-full w-full opacity-0"
                    @input="form.image = $event.target.files[0]"
                    accept=".jpg, .jpeg, .png"
                  />

                  <div class="text-red-500" v-if="errors.image">{{ errors.image }}</div>
                </div>

                <div class="flex justify-between items-center text-gray-400">
                  <span>Accepted file type:.jpg, .jpeg, .png only</span>
                  <span class="flex items-center">
                    <i class="fa fa-lock mr-1"></i> secure
                  </span>
                </div>
              </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button
                @click.prevent="update"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              >Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>

<script>
import { Link, Head } from "@inertiajs/inertia-vue";
import ContentHeaderVue from "@/Components/Layout/ContentHeader";
import Pagination from "@/Components/Pagination";
import Alert from "@/Components/Alert";
import Layout from "@/Components/Layout/Layout";
import BreadCrumb from "@/Pages/Tour/BreadCrumb";
import Icon from "@/Components/Icon";

export default {
  props: {
    template: Object,
    errors: Object
  },
  layout: Layout,
  components: {
    Link,
    ContentHeaderVue,
    Pagination,
    Alert,
    BreadCrumb,
    Head,
    Icon
  },
  data() {
    return {
      image: null,
      editMode: false,
      thumb: null,
      form: this.$inertia.form({
        name: this.template.name,
        image: null,
        link_code: this.template.link_code
      }),
      crumbs: [
        {
          route: "template.index",
          parma: null,
          name: "Template"
        },
        {
          route: "template.edit",
          parma: this.template.id,
          name: "Edit"
        }
      ]
    };
  },
  methods: {
    reset() {
      (this.thumb = null),
        (this.form = this.$inertia.form({
          name: this.template.name,
          image: null,
          link_code: this.template.link_code
        }));
    },
    update() {
      this.form.post(route("template.update", this.template.id), {
        preserveState: true,
        onError: errors => {
          if (Object.keys(errors).length > 0) {
            this.editMode = true;
          }
        },
        onSuccess: page => {
          $("#exampleModal").modal("hide");
          this.reset();
        }
      });
    },
    onFileChange(e) {
      const file = e.target.files[0];
      this.thumb = URL.createObjectURL(file);
    }
  }
};
</script>

<style>
</style>