<template>
  <section class="content">
    <Head title ="Panos" />
    <ContentHeaderVue :name="'Panos'" :icon="'fa fa-picture-o'" />
    <alert :dismissible="true"></alert>
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
            <h5 class="modal-title" id="exampleModalLabel" v-if="editMode">Update Pano</h5>
            <h5 class="modal-title" id="exampleModalLabel" v-else>Create Pano</h5>

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
                  :class="errors.name ? 'is-valid' :''"
                  v-model="form.name"
                  id="recipient-name"
                />
                <div class="text-red-500" v-if="errors.name">{{ errors.name }}</div>
              </div>
              <div class="form-group" :class="errors.voice ? 'is-valid' :''">
                <label for="recipient-name" class="col-form-label">
                  Upload
                  Voice (mp3,mp4)
                </label>
                <div class="flex items-center justify-center w-full">
                  <label
                    class="flex flex-col w-full h-32 border-4 border-dashed hover:bg-gray-100 hover:border-gray-300"
                  >
                  <div class="flex">
                    <audio :src="voice" controls class=" h-16 mt-7 w-full"></audio>
                    <div class="flex flex-col items-center justify-center pt-7 w-full">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-gray-400 group-hover:text-gray-600"
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
                      >Select a voice</p>
                     
                    </div>
                   
                  </div>
                    
                    <input
                      type="file"
                      @input="form.voice = $event.target.files[0]"
                      :class="errors.voice ? 'is-valid' :''"
                      @change="onFileChangeVoice
"
                      class="opacity-0"
                     
                      accept="audio/*"
                    />
                  </label>
                  <div class="text-red-500" v-if="errors.voice">{{ errors.voice }}</div>
                </div>
              </div>
              <!-- <div class="form-group" :class="errors.thumb ? 'is-valid' :''">
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
                    <img class="h-6 w-6 text-gray-400" :src="thumb" />
                    <input
                      type="file"
                      @input="form.thumb = $event.target.files[0]"
                      :class="errors.thumb ? 'is-valid' :''"
                      @change="onFileChangeThumb
"
                      class="opacity-0"
                      accept=".jpg, .png"
                    />
                  </label>
                  <div class="text-red-500" v-if="errors.thumb">{{ errors.thumb }}</div>
                </div>
              </div> -->
              <div class="modal-footer">
                <button
                  type="button"
                  class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                  data-dismiss="modal"
                  @click="cloesModal()"
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
    <!-- <div class="col-auto justify-end text-right">
      <div class="btn-group" role="group">
        <button
          type="button"
          class="btn btn-secondary"
          v-bind:class="[viewType === 'table' ? 'active' : '']"
          v-on:click="selectView('table')"
          v-bind:title="'Table'"
        >
          <i class="fa fa-th-list" />
        </button>
        <button
          role="button"
          class="btn btn-secondary"
          v-bind:class="[viewType === 'grid' ? 'active' : '']"
          v-on:click="selectView('grid')"
          v-bind:title="'Grid'"
        >
          <i class="fa fa-th" />
        </button>
      </div>
    </div>-->

    <div class="fm-grid" v-if="viewType ==='grid'">
      <div class="d-flex align-content-start flex flex-wrap">
        <draggable
          tag="element"
          v-model="panos"
          style="width: 100%;display: contents;"
          @change="onUnpublishedChange"
          v-bind="dragOptions"
          @start="isDragging = true"
          @end="isDragging = false"
        >
          <transition-group name="list" tag="div">
            <div
              class="fm-grid-item text-center unselectable"
              v-for="(pano, index) in panos"
              v-bind:key="`d-${index}`"
              v-on:dblclick.stop="selectDirectory(pano)"
            >
              <div class="fm-item-icon">
                <i class="fa-5x pb-2" v-bind:class="'fa fa-folder'"></i>
              </div>
              <div class="fm-item-info">{{ pano.name }}</div>

              <button
                data-toggle="modal"
                data-target="#exampleModal"
                class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                @click="edit(pano)"
              >
                <icon name="update" />
              </button>
            </div>
          </transition-group>
        </draggable>
      </div>
    </div>

    <div class="flex flex-col mt-6" v-if="viewType ==='table'">
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
                  >Thumb</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >ID thumb</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Voice scene</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Hotspot</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Category</th>

                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <draggable
                v-model="panos"
                tag="tbody"
                @change="onUnpublishedChange"
                v-bind="dragOptions"
                @start="isDragging = true"
                @end="isDragging = false"
                item-key="id_priority"
                class="bg-white divide-y divide-gray-200"
              >
                <template>
                  <tr v-for="(pano,index) in  panos" :key="index">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="ml-4">
                          <div class="text-xl font-medium text-gray-900">{{ index }}</div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-xl text-gray-900">{{ pano.name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-xl text-gray-900">
                        <img v-lazy="pano.thumb_img" class="w-50 h-20" />
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-xl text-gray-900">{{ pano.id_thumb }}</div>
                    </td>
                    <td class="px-6 py-4 w-24 h-40 whitespace-nowrap voice_scene">
                      <audio class="w-40 h-12" :src="pano.path_onstart" controls ></audio>
                     
                    </td>
                    <td>
                      <Link
                        :href="route('tour.pano.hotspot.index',[tour.code,pano.id])"
                        class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                        v-bind:title="'Hotspot'"
                      >
                        <i class="fa fa-map-pin" />
                        Hotspot
                      </Link>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-xl text-gray-900">
                        <select
                          id="countries"
                          @change="onChangeElement(pano,$event)"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                          <option value :selected="pano.element==null ?true :false"></option>
                          <option
                            v-for="(category,index) in category_panos"
                            :key="index"
                            :value="category.id"
                            :selected="pano.category_pano_id ==category.id ?true :false"
                          >{{category.name}}</option>
                        </select>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                      <button
                        data-toggle="modal"
                        data-target="#exampleModal"
                        class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                        @click="edit(pano)"
                      >Update</button>
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
import draggable from "vuedraggable";
import { Link,Head } from "@inertiajs/inertia-vue";
import ContentHeaderVue from "@/Components/Layout/ContentHeader";
import Pagination from "@/Components/Pagination";
import Alert from "@/Components/Alert";
import Layout from "@/Pages/Tour/Layout";
import BreadCrumb from "@/Pages/Tour/BreadCrumb";
import Icon from "@/Components/Icon.vue";
import manager from "@/Pages/Tour/Pano/mixins/manager";

export default {
  layout: Layout,
  mixins: [manager],
  components: {
    Link,
    ContentHeaderVue,
    Pagination,
    Alert,
    BreadCrumb,
    Icon,
    draggable,
    Head
  },
  props: {
    tour: Object,
    errors: Object,
    panos: Array,
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
      term: null,
      viewType: "table",
      editMode: false,
      voice: null,
      form: this.$inertia.form({
        id: null,
        name: null,
        voice: null,
        category: null,
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
          route: "tour.pano.index",
          parma: this.tour.id,
          name: "Panos"
        }
      ]
    };
  },
  methods: {
    save() {
      if (this.editMode) {
        this.form.post(route("tour.pano.update", this.form.id), {
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
      }
    },
    reset(){
      this.form= this.$inertia.form({
        id: null,
        name: null,
        voice: null,
        category: null,
      })
    },
    clickModal() {
      this.editMode = false;
      this.reset();
    },

    deleteRow(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(route("tour.destroy", id));
    },
    onFileChangeVoice(e) {
      const file = e.target.files[0];
      this.voice = URL.createObjectURL(file);
    },
    onChangeElement(data, event) {
      let query = {
        category: event.target.value,
        id: data.id
      };
      this.$inertia.post("/pano/selectCategory", query, {
        preserveState: true
      });
    },
    selectDirectory(pano) {
      this.$inertia.get(route("tour.hotspot.index", pano.id));
    },
    selectView(text) {
      this.viewType = text;
    },
    onUnpublishedChange() {
      let query = {
        data: this.panos
      };
      this.$inertia.post(this.route("pano.sort"), query, {
        preserveState: false
      });
    }
  }
};
</script>
<style>
</style>