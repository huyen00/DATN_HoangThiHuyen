<template>
  <section class="content">
    <Head title="Font"></Head>
    <ContentHeaderVue :name="'Font'" :icon="'fa fa-font'" />
    <alert :dismissible="true"></alert>
    <BreadCrumb :crumbs="crumbs" />
    <button
      v-if="font ==null"
      type="button"
      class="inline-block px-8 py-4 bg-blue-600 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
      data-toggle="modal"
      data-target="#exampleModalFont"
      @click="clickModal()"
    >Create Font</button>
    <div
      class="modal fade"
      id="exampleModalFont"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" v-if="editMode">Update font</h5>
            <h5 class="modal-title" id="exampleModalLabel" v-else>Create font</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="save">
              <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <div class="form-group" :class="errors.name ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">Name</label>
                    <div class="flex items-center justify-center w-full">
                      <input
                        type="text"
                        class="form-control text-xl"
                        :class="errors.name ? 'border-red-500' :''"
                        v-model="form.name"
                        id="recipient-name"
                      />
                    </div>
                    <div class="text-red-500" v-if="errors.name">{{ errors.name }}</div>
                  </div>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <div class="form-group" :class="errors.thumb ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">
                      Upload
                      Font
                    </label>
                    <div class="flex items-center justify-center w-full">
                      <input
                        type="file"
                        @input="form.font = $event.target.files[0]"
                        :class="errors.font ? 'border-red-500' :''"
                        oninvalid="setCustomValidity('Vui lòng nhập file Font')"
                        accept=".ttf, .font, .sfnt"
                      />

                      <div class="text-red-500" v-if="errors.font">{{ errors.font }}</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <div class="form-group" :class="errors.size ? 'is-valid' :''">
                    <label for="fontSize" class="col-form-label">Size</label>
                    <div class="flex items-center justify-center w-full">
                      <input
                        type="number"
                        min="0"
                        placeholder="(Cơ chữ)"
                        class="form-control text-xl"
                        :class="errors.size ? 'border-red-500' :''"
                        v-model="form.size"
                        id="fontSize"
                      />
                    </div>
                    <div class="text-red-500" v-if="errors.size">{{ errors.size }}</div>
                  </div>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <div class="form-group" :class="errors.weight ? 'is-valid' :''">
                    <label for="fontWeight" class="col-form-label">Weight</label>
                    <div class="flex items-center justify-center w-full">
                      <input
                        type="number"
                        min="100"
                        placeholder="(Độ dày mỏng của chữ: 100-800)"
                        class="form-control text-xl"
                        :class="errors.weight ? 'border-red-500' :''"
                        v-model="form.weight"
                        id="fontWeight"
                      />
                    </div>
                    <div class="text-red-500" v-if="errors.weight">{{ errors.weight }}</div>
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <button
                  type="button"
                  class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                  data-dismiss="modal"
                  @click="reset()"
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
    <div v-if="font" class="flex flex-col mt-6">
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
                  >Name</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Size</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Weight</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Favicon</th>

                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">1</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">{{font.name}}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">{{font.size}}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">{{font.weight}}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">{{font.font}}</div>
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button
                      data-toggle="modal"
                      data-target="#exampleModalFont"
                      @click="edit(font)"
                      class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                    >Update</button>
                    <button
                      @click="deleteRow(font.id)"
                      class="inline-block px-6 py-2.5 bg-gray-800 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out"
                    >Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
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
    font: Object
  },
  data() {
    return {
      editMode: false,
      form: this.$inertia.form({
        font: null,
        name: null,
        size: null,
        weight: null
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
          route: "tour.font.index",
          parma: this.tour.id,
          name: "Font"
        }
      ]
    };
  },
  methods: {
    save() {
      this.form.post(route("tour.font.store", this.tour.id), {
        preserveState: true,
        onError: errors => {
          if (Object.keys(errors).length > 0) {
            this.editMode = false;
          }
        },
        onSuccess: page => {
          $("#exampleModalFont").modal("hide");
          this.reset();
        }
      });
    },
    reset: function() {
      this.form = this.$inertia.form({
        font: null,
        name: null,
        size: null,
        weight: null
      });
    },

    clickModal() {
      this.editMode = false;
      this.reset();
        $('#exampleModalFont').on('shown.bs.modal', function () {
        $('#recipient-name').focus()
    });
    },
    edit(data) {
      this.editMode = true;
      this.form.name = data.name;
      this.form.size = data.size;
      this.form.weight = data.weight;
        $('#exampleModalFont').on('shown.bs.modal', function () {
        $('#recipient-name').focus()
    });
    },
    deleteRow(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(route("tour.font.delete", id));
    }
  }
};
</script>

<style>
</style>
