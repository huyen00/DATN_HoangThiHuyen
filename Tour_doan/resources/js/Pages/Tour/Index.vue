<template>
  <section class="content">
    <Head title="Tour" />
    <ContentHeaderVue :name="'Tour'" />
    <alert :dismissible="true"></alert>

    <button
      type="button"
      class="inline-block px-8 py-4 bg-blue-600 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
      data-toggle="modal"
      data-target="#exampleModal"
      @click="clickModal()"
    >Create Tour</button>
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
            <h5 class="modal-title" id="exampleModalLabel" v-if="editMode">Update Tour</h5>
            <h5 class="modal-title" id="exampleModalLabel" v-else>Create Tour</h5>

            <button  type="button" class="close" data-dismiss="modal" aria-label="Close" :disabled="form.processing">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="save">
              <div
                class="w-1/4 bg-gray-200 rounded-full dark:bg-gray-700 mb-8 ml-3"
                v-if="form.progress"
              >
                <div
                  class="bg-blue-600 text-xl font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                  :style="{ width: form.progress.percentage + '%' }"
                >{{ form.progress.percentage }}%</div>
              </div>
              <div class="relative p-6 flex-auto">
                <div class="flex flex-wrap -mx-3 mb-6">
                  <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label
                      class="block uppercase tracking-wide text-gray-700 text-xl font-bold mb-2"
                      for="nameTour"
                    >{{__('name')}}</label>
                    <input
                      class="appearance-none block w-full bg-gray-200 text-gray-500 border rounded py-4 px-3 mb-3 text-xl leading-tight focus:outline-none focus:bg-white"
                      id="nameTour"
                      type="text"
                      placeholder
                      v-model="form.name"
                      :class="errors.name ? 'border-red-500' :''"
                    />
                    <p class="text-red-500 text-xl italic" v-if="errors.name">{{ errors.name }}</p>
                  </div>
                  <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label
                      class="block uppercase tracking-wide text-gray-700 text-xl font-bold mb-2"
                      for="grid-first-name"
                    >{{__('tour')}}</label>
                    <input
                      class="appearance-none block w-full bg-gray-200 text-gray-500 border rounded py-4 px-3 mb-3 text-xl leading-tight focus:outline-none focus:bg-white"
                      id="grid-first-name"
                      type="file"
                      placeholder
                      @input="form.path = $event.target.files[0]"
                      accept=".zip"
                      :class="errors.path ? 'border-red-500' :''"
                    />
                    <p class="text-red-500 text-xl italic" v-if="errors.path">{{ errors.path }}</p>
                  </div>
                  <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="container">Update all
                        <input type="checkbox" v-model="form.checkbox" >
                        <span class="checkmark"></span>
                    </label>
                  </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6"></div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                  data-dismiss="modal"
                  :disabled="form.processing"
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
                  >Editor</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Preview</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Clone</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Template</th>

                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="(tour,index) in  tours.data" :key="index">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="ml-4">
                        <div class="text-xl font-medium text-gray-900">{{ index }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">
                      <Link :href="route('tour.pano.index',tour.id)">{{ tour.name }}</Link>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <a :href="route('tour_editor.index',tour.id)" target="_black"><i class="fa fa-external-link" aria-hidden="true"></i></a>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <a :href="route('tour.preview',tour.code)" target="_black" ><i class="fa fa-external-link" aria-hidden="true"></i></a>

                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <Link
                    :href="route('tour.clone', tour.id)"
                    type="button"
                    class="btn btn-secondary"
                    v-bind:title="'Clone'"
                  >
                    <Icon name="coppy"/>
                  </Link>
                  </td>
                  <td>

                      <select
                      id="countries"
                      @change="onChangeElement(tour,$event)"
                      :class="errors.template_id ? 'border-red-500' :''"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                      <option
                        v-for="(template,index) in templates"
                        :key="index"
                        :selected="tour.template && template.id==tour.template.id  ? true :false"
                        :value="template.id"
                      >{{template.name}}</option>
                    </select>
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button
                      data-toggle="modal"
                      data-target="#exampleModal"
                      class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                      @click="edit(tour)"

                    >Update</button>
                    <button
                      @click="deleteRow(tour.id)"
                      class="inline-block px-6 py-2.5 bg-gray-800 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out"
                    >Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
            <pagination class="mt-6" :links="tours.links" />
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
    tours: Object,
    errors: Object,
    templates:Array
  },
  data() {
    return {
      term: null,
      editMode: false,
      form: this.$inertia.form({
        id: null,
        name: null,
        path: null,
        checkbox : false
      }),
      crumbs: [
        {
          route: "tour.index",
          parma: null,
          name: "Tour",
          checkbox : false
        }
      ]
    };
  },
  methods: {
    search() {
      this.$inertia.get(
        this.route("tour.index"),
        { term: this.term },
        {
          preserveState: true
        }
      );
    },
    save() {
      if (this.editMode) {
        this.form.post(route("tour.update", this.form.id), {
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
        this.form.post(route("tour.store"), {
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
        path: null,
        checkbox : false
      });
    },

    clickModal() {
      this.editMode = false;
      this.checkbox = false;
        $('#exampleModal').on('shown.bs.modal', function () {
        $('#nameTour').focus()
    });
      this.reset();
    },
    edit(data) {
      this.editMode = true;
      this.form.id = data.id;
      this.form.name = data.name;
      this.form.html = data.html;
      this.form.checkbox = data.checkbox;
      this.editMode = true;
         $('#exampleModal').on('shown.bs.modal', function() {
                $('#nameTour').focus()
            });
    },
    deleteRow(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(route("tour.delete", id));
    },
    onChangeElement(tour, event) {
      let query = {
        template_id: event.target.value
      };
      this.$inertia.post(`/tours/${tour.id}/template`, query, {
        preserveState: true
      });
    },
  }
};
</script>
<style>
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
