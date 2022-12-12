<template>
  <section class="content">
             <Head title="Icons"></Head>
    <ContentHeaderVue :name="'Icons'" :icon="'fa fa-flag'" />
    <alert :dismissible="true"></alert>
    <button
      type="button"
      class="inline-block px-8 py-4 bg-blue-600 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
      data-toggle="modal"
      data-target="#exampleModal"
      @click="clickModal()"
    >Create Icon</button>
    <button style="margin: 5px;" class="inline-block px-8 py-4 bg-red-600 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out" data-url="" @click="DeleteCheckbox()">{{__('delete')}} CheckBox</button>
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
            <h5 class="modal-title" id="exampleModalLabel" v-if="editMode">Update Icon</h5>
            <h5 class="modal-title" id="exampleModalLabel" v-else>Create Icon</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="save">
              <div class="form-group" :class="errors.name ? 'is-valid' :''">
                <label for="recipient-name" class="col-form-label">Name:</label>
                <input
                  type="text"
                  class="form-control text-xl"
                  :class="errors.name ? 'border-red-500' :''"
                  v-model="form.name"
                  id="recipient-name"
                />
                <div class="text-red-500" v-if="errors.name">{{ errors.name }}</div>
              </div>
              <div class="form-group" :class="errors.thumb ? 'is-valid' :''">
                <label for="recipient-name" class="col-form-label">
                  Upload
                  Icon (jpg,png)
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
                    <img class="h-6 w-6 text-gray-400" :src="icon" />
                    <input
                      type="file"
                      @input="form.icon = $event.target.files[0]"
                      :class="errors.icon ? 'border-red-500' :''"
                      @change="onFileChangeThumb
"
                      class="opacity-0"
                      accept=".jpg, .png"
                    />
                  </label>
                  <div class="text-red-500" v-if="errors.icon">{{ errors.icon }}</div>
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
    <div class="w-full max-w-md mr-4 mb-8 mt-8">
      <input
        v-model="term"
        @keyup="search"
        class="relative w-full px-8 py-3 text-xl rounded-r focus:shadow-outline"
        autocomplete="off"
        type="text"
        name="search"
        placeholder="Search…"
      />
    </div>
    <div class="flex flex-col mt-6">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"><input type="checkbox" id="check_all" v-model="selectAll"></th>
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
                  >Icon</th>

                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="(icon,index) in  icons.data" :key="index">
                  <td class="px-6 py-4 whitespace-nowrap"><input type="checkbox" class="checkbox" v-model="selected" :value="icon.id"></td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="ml-4">
                        <div class="text-xl font-medium text-gray-900">{{ index }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">{{ icon.name }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">
                      <img v-lazy="icon.icon" class="w-50 h-20 bg-gray-300" />
                    </div>
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button
                      data-toggle="modal"
                      data-target="#exampleModal"
                      class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                      @click="edit(icon)"
                    >Update</button>
                    <button
                      @click="deleteRow(icon.id)"
                      class="inline-block px-6 py-2.5 bg-gray-800 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out"
                    >Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
            <pagination class="mt-6" :links="icons.links" />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { Link,Head } from "@inertiajs/inertia-vue";
import ContentHeaderVue from "@/Components/Layout/ContentHeader";
import Pagination from "@/Components/Pagination";
import Alert from "@/Components/Alert";
import Layout from "@/Pages/Tour/Layout";
import BreadCrumb from "@/Pages/Tour/BreadCrumb";
export default {
  layout: Layout,
  components: {
    Link,
    ContentHeaderVue,
    Pagination,
    Alert,
    BreadCrumb,Head
  },
  props: {
    tour: Object,
    errors: Object,
    icons: Object
  },
  data() {
    return {
      selected: [],
      term: null,
      editMode: false,
      icon: null,
      form: this.$inertia.form({
        id: null,
        name: null,
        icon: null
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
          route: "tour.icon.index",
          parma: this.tour.id,
          name: "Icons"
        }
      ]
    };
  },
  computed: {
        selectAll: {
            get: function () {
                return this.icons.data ? this.selected.length == this.icons.data : false;
            },
            set: function (value) {
                var selected = [];

                if (value) {
                  this.icons.data.forEach(function (icon) {
                        selected.push(icon.id);
                    });
                }

                this.selected = selected;
            }
        }
    },
  methods: {
    search() {
      this.$inertia.get(
        this.route("tour.icon.index", this.tour.id),
        { term: this.term },
        {
          preserveState: true
        }
      );
    },
    save() {
      if (this.editMode) {
        this.form.post(route("tour.icon.update", this.form.id), {
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
        this.form.post(route("tour.icon.store", this.tour.id), {
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
        icon: null
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
      this.$inertia.delete(route("tour.icon.delete", id));
    },
    onFileChangeThumb(e) {
      const file = e.target.files[0];
      this.icon = URL.createObjectURL(file);
    },
    DeleteCheckbox(){
            let query={
             ids:this.selected
           }
          this.$inertia.delete(this.route('tour.icon.deleteAll',query))
      }

  }
};
</script>
<style>
</style>