<template>
  <section class="content">
    <!-- <ContextMenu /> -->
    <ContentHeaderVue :name="'Category Pano'" />
    <alert :dismissible="true"></alert>
    <button
      type="button"
      class="inline-block px-8 py-4 bg-blue-600 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
      data-toggle="modal"
      data-target="#exampleModal"
      @click="clickModal()"
    >Create Category Pano</button>

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
            <h5 class="modal-title" id="exampleModalLabel" v-if="editMode">Update Category Pano</h5>
            <h5 class="modal-title" id="exampleModalLabel" v-else>Create Category Pano</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="save">
              <div class="form-group" :class="errors.name ? 'is-valid' :''">
                <label for="recipient-name" class="col-form-label">Name:</label>
                <input
                  v-focus
                  type="text"
                  class="form-control text-xl"
                  :class="errors.name ? 'is-valid' :''"
                  v-model="form.name"
                  id="recipient-name"
                 
                />
                <div class="text-red-500" v-if="errors.name">{{ errors.name }}</div>
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
    <BreadCrumb :crumbs="crumbs" />
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg mt-5">
      <table class="w-full text-xl text-left text-gray-500 dark:text-gray-400">
        <thead
          class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="py-3 px-6 text-xl">STT</th>
            <th scope="col" class="py-3 px-6 text-xl">name</th>
            <th scope="col" class="py-3 px-6 text-xl">
              <span class="sr-only">Edit</span>
            </th>
          </tr>
        </thead>
        <draggable
          v-model="category_panos"
          tag="tbody"
          @change="onUnpublishedChange"
          v-bind="dragOptions"
          @start="isDragging = true"
          @end="isDragging = false"
          item-key="id_priority"
          class="bg-white divide-y divide-gray-200"
        >
          <template>
            <tr
              v-for="(category,index) in category_panos"
              :key="index"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
            >
              <th
                scope="row"
                class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white"
              >{{ index}}</th>
              <th
                scope="row"
                class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white"
              >{{category.name}}</th>
              <td class="py-4 px-6 text-right">
                <button
                  @click="edit(category)"
                  type="button"
                  data-toggle="modal"
                  data-target="#exampleModal"
                  class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                >Edit</button>
                <button
                  type="button"
                  @click="Delete(category.id)"
                  class="inline-block px-6 py-2.5 bg-gray-800 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out"
                >Delete</button>
              </td>
            </tr>
          </template>
        </draggable>
      </table>
    </div>
  </section>
</template>

<script>
import draggable from "vuedraggable";
import { Link } from "@inertiajs/inertia-vue";
import Layout from "@/Pages/Tour/Layout";
import ContentHeaderVue from "@/Components/Layout/ContentHeader";
import Pagination from "@/Components/Pagination";
import Alert from "@/Components/Alert";
import BreadCrumb from "@/Pages/Tour/BreadCrumb";
export default {
  layout: Layout,
  components: {
    Link,
    ContentHeaderVue,
    Pagination,
    Alert,
    draggable,
    BreadCrumb
  },
  props: {
    errors: Object,
    tour: Object,
    category_panos: Array
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
  data() {
    return {
      editMode: false,
      showModal: false,
      form: this.$inertia.form({
        id: null,
        name: null
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
          route: "tour.category-pano.index",
          parma: this.tour.id,
          name: "Category Pano"
        }
      ]
    };
  },
  methods: {
    save() {
      if (this.editMode) {
        this.form.put(route("tour.category-pano.update", this.form.id), {
          preserveState: true,
          onError: errors => {
            if (Object.keys(errors).length > 0) {
              this.editMode = true;
            }
          },
          onSuccess: page => {
            $("#exampleModal").modal("hide");
            this.form.reset();
          }
        });
      } else {
        this.form.post(route("tour.category-pano.store", this.tour.id), {
          preserveState: true,
          onError: errors => {
            if (Object.keys(errors).length > 0) {
              this.editMode = false;
            }
          },
          onSuccess: page => {
            $("#exampleModal").modal("hide");
            this.form.reset();
          }
        });
      }
    },

    clickModal() {
      this.editMode = false
      $('#exampleModal').on('shown.bs.modal', function () {
        $('#recipient-name').focus()
    });
      this.form.reset();
    },
    edit(data) {
      this.editMode = true;
      this.form.id = data.id;
      this.form.name = data.name;
        $('#exampleModal').on('shown.bs.modal', function () {
        $('#recipient-name').focus()
    });
    },
    Delete(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(route("tour.category-pano.delete", id));
    },
    onUnpublishedChange() {
      let query = {
        data: this.category_panos
      };
      this.$inertia.post(this.route("category-pano.sort"), query, {
        preserveState: false
      });
    }
  }
};
</script>

<style>
</style>