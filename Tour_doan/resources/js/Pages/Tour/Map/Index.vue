<template>
  <section class="content">
    <Head title="Map"></Head>
    <ContentHeaderVue :name="'Map'" :icon="'fa fa-map-marker'" />
    <alert :dismissible="true"></alert>
    <button
      v-if="map ==null"
      type="button"
      class="inline-block px-8 py-4 bg-blue-600 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
      data-toggle="modal"
      data-target="#exampleModal"
      @click="clickModal()"
    >Create Map</button>
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
            <h5 class="modal-title" id="exampleModalLabel" v-if="editMode">Update Map</h5>
            <h5 class="modal-title" id="exampleModalLabel" v-else>Create Map</h5>

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
                  <div class="form-group" :class="errors.address ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">Address</label>
                    <div class="flex items-center justify-center w-full">
                      <input
                        type="text"
                        class="form-control text-xl"
                        :class="errors.address ? 'border-red-500' :''"
                        v-model="form.address"
                        id="recipient-name"
                      />
                    </div>
                    <div class="text-red-500" v-if="errors.address">{{ errors.address }}</div>
                  </div>
                </div>
              </div>
              <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <div class="form-group" :class="errors.longtitude ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">Longtitude</label>
                    <div class="flex items-center justify-center w-full">
                      <input
                        type="number"
                        class="form-control text-xl"
                        :class="errors.longtitude ? 'border-red-500' :''"
                        v-model="form.longtitude"
                        id="recipient-name"
                      />
                    </div>
                    <div class="text-red-500" v-if="errors.longtitude">{{ errors.longtitude }}</div>
                  </div>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <div class="form-group" :class="errors.latitude ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">Latitude</label>
                    <div class="flex items-center justify-center w-full">
                      <input
                        type="number"
                        class="form-control text-xl"
                        :class="errors.latitude ? 'border-red-500' :''"
                        v-model="form.latitude"
                        id="recipient-name"
                      />
                    </div>
                    <div class="text-red-500" v-if="errors.latitude">{{ errors.latitude }}</div>
                  </div>
                </div>
              </div>
              <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <div class="form-group" :class="errors.thumb ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">
                      Upload
                      Image (jpg,png)
                    </label>
                    <div class="flex items-center justify-center w-full">
                      <input
                        type="file"
                        @input="form.image = $event.target.files[0]"
                        :class="errors.image ? 'border-red-500' :''"
                        @change="onFileChangeThumb"
                        accept=".jpg, .png"
                      />
                      <img class="w-1/2 h-32 text-gray-400" v-if="image" :src="image" />
                      <img
                        class="w-1/2 h-32 text-gray-400"
                        v-else-if="map && map.image"
                        v-lazy="map.image"
                      />
                    </div>
                    <div class="text-red-500" v-if="errors.image">{{ errors.image }}</div>
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
    <div v-if="map" class="flex justify-center items-center md:flex-row md:h-96 mx-2">
      <div class="bg-white h-80 rounded shadow-md flex card text-grey-darkest">
        <img class="w-1/2 h-full rounded-l-sm" :src="map.image" alt="Room Image" />
        <div class="w-full flex flex-col">
          <div class="p-4 pb-0 flex-1">
            <h3 class="text-5xl text-grey-darkest">{{map.name}}</h3>
            <div class="text-2xl flex items-center mb-4">
              <i class="fa fa-map-marker mr-1 text-grey-dark"></i>
              {{map.address}}
            </div>

            <div class="flex items-center mt-4">
              <div class="pr-2 text-2xl text-grey-darkest">
                <strong>Longtitude:</strong>
                {{map.longtitude}}
              </div>
              <div class="px-2 text-2xl text-grey-darkest">
                <strong>Latitude:</strong>
                {{map.latitude}}
              </div>
            </div>
          </div>
          <div
            class="bg-grey-lighter p-3 flex items-center justify-end transition hover:bg-grey-light"
          >
            <button
              data-toggle="modal"
              data-target="#exampleModal"
              @click="edit(map)"
              class="inline-block mr-4 px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
            >
              <icon class="w-6 h-6" name="update"></icon>
            </button>
            <button
              @click="deleteRow(map.id)"
              class="inline-block mr-4 px-6 py-2.5 bg-red-500 text-gray-200 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-red-600 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-600 active:shadow-lg transition duration-150 ease-in-out"
            >
              <icon class="w-6 h-6" name="delete"></icon>
            </button>
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
import Icon from "@/Components/Icon";
export default {
  layout: Layout,
  components: {
    Link,
    ContentHeaderVue,
    Pagination,
    Alert,
    Icon,
    BreadCrumb,
    Head
  },
  props: {
    tour: Object,
    map: Object,
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
        image: null,
        address: null,
        latitude: null,
        longtitude: null
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
          route: "tour.map.index",
          parma: this.tour.id,
          name: "Map"
        }
      ]
    };
  },
  methods: {
    save() {
      if (this.editMode) {
        this.form.post(route("tour.map.store", this.tour.id), {
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
        this.form.post(route("tour.map.store", this.tour.id), {
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
        image: null,
        address: null,
        latitude: null,
        longtitude: null
      });

      this.image = null;
    },

    clickModal() {
      this.editMode = false;
      this.reset();
    },
    edit(data) {
      this.editMode = true;
      this.form.id = data.id;
      this.form.name = data.name;
      this.form.address = data.address;
      this.form.latitude = data.latitude;
      this.form.longtitude = data.longtitude;
    },
    deleteRow(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(route("tour.map.delete", id));
    },
    onFileChangeThumb(e) {
      const file = e.target.files[0];
      this.thumb = URL.createObjectURL(file);
    }
  }
};
</script>

<style>
</style>