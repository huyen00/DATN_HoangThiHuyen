<template>
      <section class="content">
    <!-- <ContextMenu /> -->

    <ContentHeaderVue :name="'Page'" />
    <alert :dismissible="true"></alert>
  <div class="mt-20 sm:mt-0">
    <!-- <BreadCrumbVue :page="page" :section="section" :name="null" /> -->
    <div class="mb-1 mt-4 flex justify-between items-center">
      <div class="flex items-center justify-end">
        <button
          class="flex items-center bg-gray-500 text-white active:bg-pink-600 font-sans text-xl px-4 py-1.5 rounded shadow-md hover:bg-gray-700 hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
          
          @click="onAdd()"
        >
          <icon class="w-6 h-6" name="create" />Add Image
        </button>
      </div>
    </div>
    <ModalImage :errors="errors" :content="content" />
    <BreadCrumb :crumbs="crumbs" />
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-xl text-left text-gray-500 dark:text-gray-400">
        <thead
          class="text-xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="px-6 py-3">STT</th>
            <th scope="col" class="px-6 py-3">Name</th>
            <th scope="col" class="px-6 py-3">
              <icon name="image" />
            </th>
            <th scope="col" class="px-6 py-3">Element</th>
            <th scope="col" class="px-6 py-3">embed width height</th>
            <th scope="col" class="px-6 py-3">
              {{
              __("action")
              }}
            </th>
          </tr>
        </thead>
        <draggable
          v-model="list_image"
          tag="tbody"
          @change="onUnpublishedChange"
          v-bind="dragOptions"
          @start="isDragging = true"
          @end="isDragging = false"
          item-key="id_priority"
        >
          <template>
            <tr
              v-for="(image, index) in list_image"
              :key="index"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
            >
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
              >{{index +1}}</th>

              <td v-if="editMode==false" class="px-6 py-4">
                {{image.name}}
                <a
                  @click="editName(image)"
                  
                  class="inline-block px-4 py-1.5 bg-gray-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                >
                  <icon name="edit" />
                </a>
              </td>
              <td v-else class="px-6 py-4">
                <input
                  type="text"
                  ref="name_image"
                  :value="image.name"
                  :id="image.id"
                  @keyup.enter="submit(image,index)"
                  class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-xl border-gray-300"
                />
                <a
                  @click="editName(image)"
                  
                  class="inline-block px-4 py-1.5 bg-gray-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                >
                  <icon name="edit" />
                </a>
              </td>
              <td class="px-6 py-4 crop-content">
                <img v-if="image.image" class="w-50 h-20" :src="image.image" alt="Card image cap" />
              </td>
              <td class="px-6 py-4 crop-content">
                <label
                  for="countries"
                  class="block mb-2 text-xl font-medium text-gray-900 dark:text-gray-400"
                >Select Element</label>
                <select
                  id="countries"
                  @change="onChangeElement(image,$event)"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                >
                  <option value="null" :selected="image.element==null ?true :false">Defalut</option>
                  <option
                    value="gallery__item--h-2 gallery__item--v-2"
                    :selected="image.element =='gallery__item--h-2 gallery__item--v-2' ?true :false"
                  >Chiều Rộngx2 Chiều Dàix2</option>
                  <option
                    value="gallery__item--v-2"
                    :selected="image.element =='gallery__item--v-2' ?true :false"
                  >Chiều Rộngx2</option>
                  <option
                    value="gallery__item--h-2"
                    :selected="image.element =='gallery__item--h-2' ?true :false"
                  >Chiều Dàix2</option>
                  <option
                    value="gallery__item--h-2 gallery__item--v-3"
                    :selected="image.element =='gallery__item--h-2 gallery__item--v-3' ?true :false"
                  >Chiều Rộngx2 Chiều Dàix3</option>
                </select>
              </td>
              <td class="px-6 py-4 crop-content">
                <label
                  for="countries"
                  class="block mb-2 text-xl font-medium text-gray-900 dark:text-gray-400"
                >Select embed width height</label>
                <select
                  id="countries"
                  @change="onChangeEmbed(image,$event)"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                >
                  <option value="null" :selected="image.embed==null ?true :false">Defalut</option>
                  <option
                    value="embed--1-2"
                    :selected="image.embed =='embed--1-2' ?true :false"
                  >Rộngx1 Dàix2</option>
                  <option
                    value="embed--2-1"
                    :selected="image.embed =='embed--2-1' ?true :false"
                  >Rộngx2 Dàix1</option>
                  <option
                    value="embed--2-3"
                    :selected="image.embed =='embed--2-3' ?true :false"
                  >Rộngx2 Dàix3</option>
                </select>
              </td>

              <td class="px-6 py-4">
                <a
                  @click="onEdit(image)"
                  
                  class="inline-block px-4 py-1.5 bg-gray-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                >
                  <icon name="edit" />
                </a>

                <a
                  
                  @click="onDelete(image.id)"
                  class="inline-block px-4 py-1.5 bg-red-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                >
                  <icon name="delete" />
                </a>
              </td>
            </tr>
          </template>
        </draggable>
      </table>
    </div>
  </div>
  </section>
</template>

<script>
import ContentHeaderVue from "@/Components/Layout/ContentHeader";
import Alert from "@/Components/Alert";
import Icon from "@/Components/Icon";
import Layout from "@/Components/Layout/Layout";
import { Link } from "@inertiajs/inertia-vue";
import draggable from "vuedraggable";
import BreadCrumb from "@/Pages/Tour/BreadCrumb";
import ModalImage from "@/Pages/Image/ModalImage";
export default {
  layout: Layout,
  props: {
    content: Object,
    list_image: Array,
    errors: Object,
    page: Object,
    section: Object
  },
  components: {
    draggable,
    Icon,
    BreadCrumb,
    ModalImage,
    ContentHeaderVue,
    Alert
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
      name: null,
      editMode: false,
      form: this.$inertia.form({
        id: null,
        name: null,
        images: null
      }),
      crumbs: [
        {
          route: "pages",
          parma: null,
          name: "Page"
        },
        {
          route: "section.index",
          parma: this.page.id,
          name: "Sections"
        },
        {
          route: "content.index",
          parma: this.section.title,
          name: "Contents"
        },
        {
          route: "image.index",
          parma: this.content.id,
          name: "Images"
        }
      ]
    };
  },
  methods: {
    onUnpublishedChange() {
      let query = {
        data: this.list_image
      };
      this.$inertia.post(this.route("image.priority"), query, {
        preserveState: false
      });
    },
    onDelete(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(this.route("image.delete", id));
    },
    onAdd() {
      Bus.$emit("onAddImage");
    },
    onEdit(element) {
      Bus.$emit("onEditImage", element);
    },
    onChangeElement(data, event) {
      let query = {
        element: event.target.value,
        id: data.id
      };

      axios
        .post("/admin/pages/image/selectElement", query)
        .then(response => {
          setTimeout(() => {
            this.$toast.success(response.data, {
              position: "bottom-right",
              duration: 5000
            });
          }, 1000);
        })
        .catch(function(error) {
          setTimeout(() => {
            this.$toast.error(error.response.data, {
              position: "bottom-right",
              duration: 5000
            });
          }, 1000);
        });
    },
    onChangeEmbed(data, event) {
      let query = {
        embed: event.target.value,
        id: data.id
      };

      axios
        .post("/admin/pages/image/selectEmbed", query)
        .then(response => {
          setTimeout(() => {
            this.$toast.success(response.data, {
              position: "bottom-right",
              duration: 5000
            });
          }, 1000);
        })
        .catch(function(error) {
          setTimeout(() => {
            this.$toast.error(error.response.data, {
              position: "bottom-right",
              duration: 5000
            });
          }, 1000);
        });
    },
    editName(data) {
      this.name = data.name;
      // this.dragOptions.disabled = !this.dragOptions.disabled
      this.editMode = !this.editMode;
    },
    submit(data, index) {
      let query = {
        name: this.$refs.name_image[index].value,
        id: data.id
      };
      axios
        .post("/editNameImage", query)
        .then(response => {
          // this.dragOptions.disabled= false
          setTimeout(() => {
            this.$toast.success(response.data, {
              position: "bottom-right",
              duration: 5000
            });
          }, 1000);
        })
        .catch(error => {
          setTimeout(() => {
            this.$toast.error(error.response.data, {
              position: "bottom-right",
              duration: 5000
            });
          }, 1000);
        });
    }
  }
};
</script>

<style>
</style>