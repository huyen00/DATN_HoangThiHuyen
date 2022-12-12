<template>
  <section class="content">
        <Head title="Setting" />
    <ContentHeaderVue :name="'Setting'" :icon="'fa fa-cog'" />
    <alert :dismissible="true"></alert>

    <button
      v-if="setting_tour ==null"
      type="button"
      class="inline-block px-8 py-4 bg-blue-600 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
      data-toggle="modal"
      data-target="#exampleModal"
      @click="clickModal()"
    >Create Icon</button>
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
              <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <div class="form-group" :class="errors.thumb ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">
                      Upload
                      Thumb (jpg,png)
                    </label>
                    <div class="flex items-center justify-center w-full">
                      <input
                        type="file"
                        @input="form.thumb = $event.target.files[0]"
                        :class="errors.thumb ? 'is-valid' :''"
                        @change="onFileChangeThumb"
                        accept=".jpg, .png"
                      />
                      <img class="w-1/2 h-32 text-gray-400" v-if="thumb" :src="thumb" />
                      <img
                        class="w-1/2 h-32 text-gray-400"
                        v-else-if="setting_tour && setting_tour.thumb"
                        v-lazy="setting_tour.thumb"
                      />
                      <div class="text-red-500" v-if="errors.thumb">{{ errors.thumb }}</div>
                    </div>
                  </div>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <div class="form-group" :class="errors.thumb ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">
                      Upload
                      Logo (jpg,png)
                    </label>
                    <div class="flex items-center justify-center w-full">
                      <input
                        type="file"
                        @input="form.logo = $event.target.files[0]"
                        :class="errors.logo ? 'is-valid' :''"
                        @change="onFileChangeLogo"
                        accept=".jpg, .png"
                      />
                      <img class="w-1/2 h-32 text-gray-400" v-if="logo" :src="logo" />
                      <img
                        class="w-1/2 h-32 text-gray-400"
                        v-else-if="setting_tour && setting_tour.logo"
                        v-lazy="setting_tour.logo"
                      />
                      <div class="text-red-500" v-if="errors.logo">{{ errors.logo }}</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <div class="form-group" :class="errors.thumb ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">
                      Upload
                      Favicon (png)
                    </label>
                    <div class="flex items-center justify-center w-full">
                      <input
                        type="file"
                        @input="form.favicon = $event.target.files[0]"
                        :class="errors.favicon ? 'is-valid' :''"
                        @change="onFileChangeFavicon"
                        accept=".jpg, .png"
                      />
                      <img class="w-1/2 h-32 text-gray-400" v-if="favicon" :src="favicon" />
                      <img
                        class="w-1/2 h-32 text-gray-400"
                        v-else-if="setting_tour && setting_tour.favicon"
                        v-lazy="setting_tour.favicon"
                      />
                      <div class="text-red-500" v-if="errors.favicon">{{ errors.favicon }}</div>
                    </div>
                  </div>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <div class="form-group" :class="errors.description ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">
                   Description
                    </label>
                    <div class="flex items-center justify-center w-full">
                      <textarea
                      v-model="form.description"
                     
                      :class="errors.description ? 'border-red-500' :''"
                      class="form-control block w-full px-3 py-1.5 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                      placeholder="Description VietNamese"
                    ></textarea>
                   
                      <div class="text-red-500" v-if="errors.description">{{ errors.description }}</div>
                    </div>
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
    
    <BreadCrumb :crumbs="crumbs" />
    <div v-if="setting_tour" class="flex flex-col mt-6">
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
                  >Thumb</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Logo</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Favicon</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Description</th>

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
                    <div class="text-xl text-gray-900">
                      <img
                        v-if="setting_tour.thumb"
                        v-lazy="setting_tour.thumb"
                        class="w-50 h-20 bg-gray-300"
                      />
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">
                      <img
                        v-if="setting_tour.logo"
                        v-lazy="setting_tour.logo"
                        class="w-50 h-20 bg-gray-300"
                      />
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">
                      <img
                        v-if="setting_tour.favicon"
                        v-lazy="setting_tour.favicon"
                        class="w-50 h-20 bg-gray-300"
                      />
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap crop-content">
                    <div class="text-xl text-gray-900">
                      {{setting_tour.description}}
                    </div>
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button
                      data-toggle="modal"
                      data-target="#exampleModal"
                      class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                    >Update</button>
                    <button
                      @click="deleteRow(setting_tour.id)"
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
    setting_tour: Object
  },
  data() {
    return {
      term: null,
      editMode: false,
      favicon: null,
      logo: null,
      thumb: null,
      form: this.$inertia.form({
        id: null,
        thumb: null,
        favicon: null,
        logo: null,
        description:null,
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
          route: "tour.setting.index",
          parma: this.tour.id,
          name: "Setting"
        }
      ]
    };
  },
  methods: {
    save() {
      if (this.editMode) {
        this.form.post(route("tour.setting.store", this.tour.id), {
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
        this.form.post(route("tour.setting.store", this.tour.id), {
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
        thumb: null,
        favicon: null,
        logo: null,
        description:null,
      });
      this.favicon = null;
      this.logo = null;
      this.thumb = null;
    },

    clickModal() {
      this.editMode = false;
      this.reset();
    },
    edit(data) {
      this.editMode = true;
      this.form.id = data.id;
    },
    deleteRow(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(route("tour.setting.delete", id));
    },
    onFileChangeThumb(e) {
      const file = e.target.files[0];
      this.thumb = URL.createObjectURL(file);
    },
    onFileChangeLogo(e) {
      const file = e.target.files[0];
      this.logo = URL.createObjectURL(file);
    },
    onFileChangeFavicon(e) {
      const file = e.target.files[0];
      this.favicon = URL.createObjectURL(file);
    },
    deleteRow(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(route("tour.setting.delete", id));
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