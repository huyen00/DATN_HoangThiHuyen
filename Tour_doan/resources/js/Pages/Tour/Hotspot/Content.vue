<template>
  <section class="content">
    <Head title="Content"></Head>
    <ContentHeaderVue :name="'Content'" :icon="'fa fa-picture-o'" />
    <alert :dismissible="true"></alert>
    <BreadCrumb :crumbs="crumbs" />
   
    <button
      type="button"
      class="inline-block mt-6 px-8 py-4 bg-blue-600 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
      data-toggle="modal"
      data-target="#exampleModal"
      @click="clickModal()"
    >Create Content</button>
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
            <h5 class="modal-title" id="exampleModalLabel" v-if="editMode">Update Content</h5>
            <h5 class="modal-title" id="exampleModalLabel" v-else>Create Content</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="save">
              <form @submit.prevent="save">
                <div class="flex flex-wrap -mx-3 mb-6">
                  <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
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
                  </div>
                  <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <div class="form-group" :class="errors.video ? 'is-valid' :''">
                      <label for="recipient-name" class="col-form-label">Video:</label>
                      <input
                        type="text"
                        class="form-control text-xl"
                        :class="errors.video ? 'border-red-500' :''"
                        v-model="form.video"
                        id="recipient-name"
                      />
                      <div class="text-red-500" v-if="errors.video">{{ errors.video }}</div>
                    </div>
                  </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                  <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <div class="form-group" :class="errors.link ? 'is-valid' :''">
                      <label for="recipient-name" class="col-form-label">Link:</label>
                      <input
                        type="text"
                        class="form-control text-xl"
                        :class="errors.link ? 'border-red-500' :''"
                        v-model="form.link"
                        id="recipient-name"
                      />
                      <div class="text-red-500" v-if="errors.link">{{ errors.link }}</div>
                    </div>
                  </div>
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

                        <div class="text-red-500" v-if="errors.thumb">{{ errors.thumb }}</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                  <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <div class="form-group" :class="errors.description_en ? 'is-valid' :''">
                      <label for="recipient-name" class="col-form-label">Description Engish:</label>
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
              </form>
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
                  >Video</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Link</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Description VietNamese</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Description English</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Image</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Voice</th>

                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="(content,index) in  contents" :key="index">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="ml-4">
                        <div class="text-xl font-medium text-gray-900">{{ index }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">{{ content.name }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">{{ content.video }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">{{ content.link }}</div>
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap">
                 
                    <div class="text-xl text-gray-900 crop-content">{{content.description_en}}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap crop-content">
                  
                    <div class="text-xl text-gray-900">{{content.description_vn}}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">
                      <img class="w-50 h-20" :src="content.image" alt />
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex">
                
                        <Link 
                        :href="route('tour.voice.index', content.id)"
                          type="button"
                          class="inline-block px-6 pt-2.5 pb-2 bg-blue-600 text-white font-medium text-xl leading-normal uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex align-center"
                        >
                          <i class="fa fa-microphone mt-1 w-3 mr-2" aria-hidden="true"></i>
                          Voice
                        </Link>
                      
                    </div>
                    <!-- <div  v-for="(element, index) in content.voices"   :key="index">
                    <label for="recipient-name" class="col-form-label">{{element.name}}</label>
                      <audio  
                        style="width: 100px"
                        controls
                      >
                        <source :src="element.voice" />
                      </audio>
                    </div> -->
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button
                      data-toggle="modal"
                      data-target="#exampleModal"
                      class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                      @click="edit(content)"
                    >Update</button>
                    <button
                      @click="deleteRow(content.id)"
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
import { Link, Head } from "@inertiajs/inertia-vue";
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
    BreadCrumb,
    Head
  },
  props: {
    pano: Object,
    tour: Object,
    errors: Object,
    hotspot: Object,
    contents: Array,
    category_voices:Array
  },

  data() {
    return {
      term: null,
      editMode: false,
      image: null,

      form: this.$inertia.form({
        id: null,
        name: null,
        video: null,
        description_en: null,
        description_vn: null,
        image: null,
        link: null
      }),
      crumbs: [
        {
          route: "tour.index",
          parma: null,
          name: "Tour"
        },
        {
          route: "tour.pano.index",
          parma: this.tour.id,
          name: "Panos"
        },
        {
          route: "tour.pano.index",
          parma: this.tour.id,
          name:this.pano.name
        },

        {
          route: "tour.pano.hotspot.index",
          parma: [this.tour.code, this.pano.id],
          name: "Hotspots"
        },
         {
          route: "tour.pano.hotspot.index",
          parma: [this.tour.code, this.pano.id],
          name: this.hotspot.name
        },
        {
          route: "tour.content.index",
          parma: [this.hotspot.id],
          name: "Contents"
        }
      ]
    };
  },
  methods: {
    search() {
      this.$inertia.get(
        this.route("tour.pano.hotspot.index", [this.tour.code, this.pano.id]),
        { term: this.term },
        {
          preserveState: true
        }
      );
    },
    save() {
      if (this.editMode) {
        this.form.post(route("tour.content.update", this.form.id), {
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
        this.form.post(route("tour.content.store", this.hotspot.id), {
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
        video: null,
        description_en: null,
        description_vn: null,
        image: null,
        link: null
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
      this.form.video = data.video;
      this.form.description_en = data.description_en;
      this.form.description_vn = data.description_vn;
      this.form.link = data.link;
      this.form.category_hotspot_id = data.category_hotspot_id;
      $("#exampleModal").on("shown.bs.modal", function() {
        $("#recipient-name").focus();
      });
    },
    deleteRow(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(route("tour.content.delete", id));
    },
    onFileChangeThumb(e) {
      const file = e.target.files[0];
      this.image = URL.createObjectURL(file);
    },

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
