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
              v-if="tour.template"
              :src="tour.template.image"
              alt="..."
              class="shadow rounded max-w-full h-auto align-middle border-none"
            />
          </div>
        </div>
      </div>
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent="update">
          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <div class="form-group" :class="errors.template_id ? 'is-valid' :''">
              <label for="recipient-name" class="col-form-label">Template:</label>
              <select
                id="countries"
                @change="onChangeElement(tour,$event)"
                v-model="form.template_id"
                :class="errors.template_id ? 'border-red-500' :''"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              >
                <option
                  v-for="(template,index) in templates"
                  :key="index"
                  :value="template.id"
                >{{template.name}}</option>
              </select>
              <div class="text-red-500" v-if="errors.template_id">{{ errors.template_id }}</div>
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
import Layout from "@/Pages/Tour/Layout";
import BreadCrumb from "@/Pages/Tour/BreadCrumb";
import Icon from "@/Components/Icon";
export default {
  props: {
    templates: Array,
    tour: Object,
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
      form: this.$inertia.form({
        template_id:this.tour.template ? this.tour.template_id :null
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
          route: "tour.template.index",
          parma: this.tour.id,
          name: "Template"
        }
      ]
    };
  },
  methods: {
    reset() {
      this.form = this.$inertia.form({});
    },
    update() {
      this.form.post(route("template.update", this.tour.id), {
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
    onChangeElement(data, event) {
      let query = {
        template_id: event.target.value
      };
      this.$inertia.post(`/tours/${this.tour.id}/template`, query, {
        preserveState: true
      });
    },
  }
};
</script>
  
  <style>
</style>