<template>
  <section class="content">
    <Head title="Template" />
    <ContentHeaderVue :name="'Template'" />
    <alert :dismissible="true"></alert>

    <button
      type="button"
      class="inline-block px-8 py-4 bg-blue-600 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
      data-toggle="modal"
      data-target="#exampleModal"
      @click="clickModal()"
    >Create Template</button>
    <BreadCrumb :crumbs="crumbs" />
    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" v-if="editMode">Update Template</h5>
            <h5 class="modal-title" id="exampleModalLabel" v-else>Create Template</h5>

            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              :disabled="form.processing"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="save">
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
              <div class="form-group" :class="errors.image ? 'is-valid' :''">
                <label for="recipient-name" class="col-form-label">
                  Upload
                  Thumb (jpg,png)
                </label>
                <div class="flex items-center justify-center w-full">
                  <label
                    class="flex flex-col w-full h-32 border-4 border-dashed hover:bg-gray-100 hover:border-gray-300"
                  >
                    <div class="flex flex-col items-center justify-center pt-7">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-12 h-12 text-gray-400 group-hover:text-gray-600"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                          clip-rule="evenodd"
                        />
                      </svg>
                      <p
                        class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600"
                      >Select a photo</p>
                    </div>
                    <img class="h-6 w-6 text-gray-400" :src="image" />
                    <input
                      type="file"
                      @input="form.image = $event.target.files[0]"
                      :class="errors.image ? 'border-red-500' :''"
                      @change="onFileChangeImage
"
                      class="opacity-0"
                      accept=".jpg, .png"
                    />
                  </label>
                  <div class="text-red-500" v-if="errors.image">{{ errors.image }}</div>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                  data-dismiss="modal"
                >Close</button>
                <button
                  @click.prevent="save()"
                  type="submit"
                  class="inline-block px-6 py-2.5 bg-gray-800 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out"
                >Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-col md:flex-row justify-center flex-wrap gap-3 mt-10">
      <div
        v-for="(template,index) in templates "
        :key="index"
        class="flex justify-center hover:shadow-2xl transition duration-500 transform hover:scale-105 cursor-pointer"
      >
        <div class="rounded-lg shadow-lg bg-white max-w-sm">
          <div data-mdb-ripple="true" data-mdb-ripple-color="light">
            <img class="rounded-t-lg" :src="template.image" alt />
          </div>
          <div class="p-6">
            <h5 class="text-gray-900 text-xl font-medium mb-2">{{template.name}}</h5>
            <p class="text-gray-700 text-base mb-4">
              <strong>Link Code:</strong>
              {{template.link_code}}
            </p>
            <div class="flex mt-4 space-x-3 md:mt-6">
              <Link
                :href="route('template.edit', template.id)"
                class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
              >
                <icon name="edit" />
              </Link>
              <button
                @click="deleteRow(template.id)"
                class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out"
              >
                <icon name="delete" />
              </button>
            </div>
          </div>
        </div>
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
  props: {
    templates: Array,
    errors: Object
  },
  data() {
    return {
      image: null,
      editMode: false,
      form: this.$inertia.form({
        name: null,
        image: null,
        link_code: null
      }),
      crumbs: [
        {
          route: "template.index",
          parma: null,
          name: "Template"
        }
      ]
    };
  },
  methods: {
    reset() {
      this.form = this.$inertia.form({
        name: null,
        image: null,
        link_code: null
      });
    },
    save() {
      if (this.editMode) {
        this.form.post(route("template.update", this.form.id), {
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
      } else {
        this.form.post(route("template.store"), {
          preserveState: true,
          onError: errors => {
            if (Object.keys(errors).length > 0) {
              this.editMode = false;
            }
          },
          onSuccess: page => {
            $("#exampleModal").modal("hide");
            this.reset();
          }
        });
      }
    },
    clickModal() {
      this.editMode = false;
      $("#exampleModal").on("shown.bs.modal", function() {
        $("#nameTour").focus();
      });
      this.reset();
    },
    onFileChangeImage(e) {
      const file = e.target.files[0];
      this.image = URL.createObjectURL(file);
    },
    edit(data) {
      this.editMode = true;
      this.form.id = data.id;
      this.form.name = data.name;
      this.form.link_code = data.link_code;
      this.editMode = true;
      $("#exampleModal").on("shown.bs.modal", function() {
        $("#nameTour").focus();
      });
    },
    deleteRow(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(route("template.delete", id));
    }
  }
};
</script>

<style>
</style>