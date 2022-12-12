<template>
  <section class="content">
    <Head title="Infor"></Head>
    <ContentHeaderVue :name="'Infor'" :icon="'fa fa-picture-o'" />
    <alert :dismissible="true"></alert>
    <BreadCrumb :crumbs="crumbs" />

    <button
      type="button"
      class="inline-block mt-6 px-8 py-4 bg-blue-600 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
      data-toggle="modal"
      data-target="#exampleModal"
      @click="clickModal()"
    >Create Infor</button>
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
            <h5 class="modal-title" id="exampleModalLabel" v-if="editMode">Update Infor</h5>
            <h5 class="modal-title" id="exampleModalLabel" v-else>Create Infor</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="save">
              <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0" v-if="editMode">
                  <div class="form-group" :class="errors.name ? 'is-valid' :''"  >
                    <label for="recipient-name" class="col-form-label">Title:</label>
                    <input
                      type="text"
                      class="form-control text-xl"
                      :class="errors.name ? 'border-red-500' :''"
                      v-model="form.name"
                      id="recipient-name"
                    />
                    <div class="text-red-500" v-if="errors.name">{{ errors.name }}</div>
                  </div>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <div
                    class="form-group"
                    :class="errors.images ? 'is-valid' :''"
                    v-if="editMode ==false"
                  >
                    <label for="recipient-name" class="col-form-label">
                      Upload
                      Image (jpg,png)
                    </label>
                    <div class="flex items-center justify-center w-full">
                      <input
                        type="file"
                        multiple
                        @input="form.images = $event.target.files"
                        :class="errors.images ? 'border-red-500' :''"
                        accept=".jpg, .png"
                      />

                      <div class="text-red-500" v-if="errors.images">{{ errors.images }}</div>
                    </div>
                  </div>
                  <div class="form-group" :class="errors.image ? 'is-valid' :''" v-else>
                    <label for="recipient-name" class="col-form-label">
                      Upload
                      Image (jpg,png)
                    </label>
                    <div class="flex items-center justify-center w-full">
                      <input
                        type="file"
                        @input="form.image = $event.target.files[0]"
                        :class="errors.image? 'border-red-500' :''"
                        accept=".jpg, .png"
                      />

                      <div class="text-red-500" v-if="errors.image">{{ errors.image }}</div>
                    </div>
                  </div>
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

    <div class="flex flex-col mt-6">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >id</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >name</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Image</th>

                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <draggable
                v-model="images"
                tag="tbody"
                @change="onUnpublishedChange"
                v-bind="dragOptions"
                @start="isDragging = true"
                @end="isDragging = false"
                item-key="id_priority"
              >
                <template>
                  <tr
                    v-for="(image,index) in  images"
                    :key="index"
                    class="bg-white divide-y divide-gray-200"
                  >
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="ml-4">
                          <div class="text-xl font-medium text-gray-900">{{ index }}</div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-xl text-gray-900">{{ image.name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-xl text-gray-900">
                        <img v-lazy="image.image" class="w-50 h-20" alt />
                      </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                      <button
                        data-toggle="modal"
                        data-target="#exampleModal"
                        class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                        @click="edit(image)"
                      >Update</button>
                      <button
                        @click="deleteRow(image.id)"
                        class="inline-block px-6 py-2.5 bg-gray-800 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out"
                      >Delete</button>
                    </td>
                  </tr>
                </template>
              </draggable>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { Link, Head } from "@inertiajs/inertia-vue";
import Layout from "@/Pages/Tour/Layout";
import ContentHeaderVue from "@/Components/Layout/ContentHeader";
import Pagination from "@/Components/Pagination";
import Alert from "@/Components/Alert";
import BreadCrumb from "@/Pages/Tour/BreadCrumb";
import Icon from "@/Components/Icon";
import draggable from "vuedraggable";
export default {
  layout: Layout,
  components: {
    Link,
    ContentHeaderVue,
    Pagination,
    Alert,
    BreadCrumb,
    Icon,
    Head,
    draggable
  },
  props: {
    tour: Object,
    infor: Object,
    images: Array,
    errors: Object
  },
  data() {
    return {
      term: null,
      editMode: false,
      image: null,
      form: this.$inertia.form({
        id: null,
        name: null,
        images: null,
        image: null
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
          route: "tour.infor.index",
          parma: this.tour.id,
          name: "Infor"
        },
        {
          route: "tour.infor.index",
          parma: this.tour.id,
          name: this.infor.title
        },
        {
          route: "tour.infor.images.index",
          parma: [this.tour.id, this.infor.id],
          name: "Images"
        }
      ]
    };
  },
  computed: {
    dragOptions() {
      return {
        animation: 100,
        group: "description",
        disabled: false,
        ghostClass: "ghost",
        scrollSensitivity: 100,
        forceFallback: true
      };
    }
  },
  methods: {
    save() {
      if (this.editMode) {
        this.form.post(route("tour.infor.images.update",  [this.infor.id, this.form.id]), {
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
        this.form.post(route("tour.infor.images.store", [this.tour.id, this.infor.id]), {
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
    reset: function() {
      this.form = this.$inertia.form({
        id: null,
        name: null,
        images: null,
        image:null
      });
    },

    clickModal() {
      this.editMode = false;
      this.reset();
      $("#exampleModal").on("shown.bs.modal", function() {
        $("#recipient-name").focus();
      });
    },
    edit(data) {
      this.editMode = true;
      this.form.id = data.id;
      this.form.name = data.name;
      $("#exampleModal").on("shown.bs.modal", function() {
        $("#recipient-name").focus();
      });
    },
    deleteRow(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(route("tour.infor.image.delete", id));
    },
    onUnpublishedChange() {
      let query = {
        data: this.images
      };
      this.$inertia.post(this.route("tour.image.priority"), query, {
        preserveState: false
      });
    }
  }
};
</script>

<style>
.crop-content {
  max-width: 120px;
  overflow-x: auto;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>