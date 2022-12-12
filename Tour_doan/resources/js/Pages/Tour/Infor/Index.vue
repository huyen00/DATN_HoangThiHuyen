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
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <div class="form-group" :class="errors.name ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">Title:</label>
                    <input
                      type="text"
                      class="form-control text-xl"
                      :class="errors.title ? 'border-red-500' :''"
                      v-model="form.title"
                      id="recipient-name"
                    />
                    <div class="text-red-500" v-if="errors.title">{{ errors.title }}</div>
                  </div>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0"  v-if="editMode== false">
                           <div class="form-group" :class="errors.thumb ? 'is-valid' :''">
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
                </div>
              </div>
              <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <div class="form-group" :class="errors.description_en ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">Description English:</label>
                    <textarea
                      v-model="form.description_en"
                     
                      :class="errors.description_en ? 'border-red-500' :''"
                      class="form-control block w-full px-3 py-1.5 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                      placeholder="Description English"
                    ></textarea>
                  </div>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <div class="form-group" :class="errors.description_vn ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">Description VietNamese:</label>
                    <textarea
                      v-model="form.description_vn"
                     
                      :class="errors.description_vn ? 'border-red-500' :''"
                      class="form-control block w-full px-3 py-1.5 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                      placeholder="Description VietNamese"
                    ></textarea>
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
                  >Title</th>
                    <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Description EN</th>
                    <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Description VN</th>
                       <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Manager</th>
                  

                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
                 <draggable
                v-model="infor_tours"
                tag="tbody"
                @change="onUnpublishedChange"
                v-bind="dragOptions"
                @start="isDragging = true"
                @end="isDragging = false"
                item-key="id_priority"
              >
                <template>
            
                <tr v-for="(infor,index) in  infor_tours" :key="index" class="bg-white divide-y divide-gray-200">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="ml-4">
                        <div class="text-xl font-medium text-gray-900">{{ index }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">
                  {{ infor.title }}
                    </div>
                  </td>
                   <td class="px-6 py-4 whitespace-nowrap crop-content">
                    <div class="text-xl text-gray-900">
                     {{infor.description_en}}
                    </div>
                  </td>
                    <td class="px-6 py-4 whitespace-nowrap crop-content">
                    <div class="text-xl text-gray-900">
                     {{infor.description_vn}}
                    </div>
                  </td>

              
                  <td class="px-6 py-4 whitespace-nowrap ">
                    <Link
                      :href="route('tour.infor.images.index', [tour.id,infor.id])"
                      class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                  
                    >Image</Link>
                        <Link
                      :href="route('tour.infor.voices.index', [tour.id,infor.id])"
                      class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                  
                    ><i class="fa fa-microphone mt-1 w-3 mr-2" aria-hidden="true"></i>Voice</Link>
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button
                      data-toggle="modal"
                      data-target="#exampleModal"
                      class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                      @click="edit(infor)"
                    >Update</button>
                    <button
                      @click="deleteRow(infor.id)"
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
  props:{
    tour:Object,
    infor_tours:Array,
    errors:Object
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
      editMode: false,
      image: null,
      form: this.$inertia.form({
        id: null,
        title: null,
        description_vn: null,
        description_en:null,
        images: null,
   
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
        }
      ]
    };
  },
  methods: {
    save() {
      if (this.editMode) {
        this.form.post(route("tour.infor.update", this.form.id), {
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
        this.form.post(route("tour.infor.store", this.tour.id), {
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
        title: null,
        description_vn: null,
        description_en:null,
        images: null,

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
      this.form.title = data.title;
      this.form.description_vn = data.description_vn,
      this.form.description_en = data.description_en,
          $("#exampleModal").on("shown.bs.modal", function() {
        $("#recipient-name").focus();
      });
    },
    deleteRow(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(route("tour.infor.delete", id));
    },
    onUnpublishedChange() {
      let query = {
        data: this.infor_tours
      };
      this.$inertia.post(this.route("tour.infor.priority"), query, {
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