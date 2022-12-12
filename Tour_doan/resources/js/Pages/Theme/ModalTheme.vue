<template>
  <div class="mb-6 flex justify-between items-center">
    <div>
      <form class="space-y-4 text-gray-700">
        <div
          v-if="showModal"
          class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex"
        >
          <div class="relative w-auto my-6 mx-auto max-w-3xl">
            <!--content-->
            <div
              class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none"
            >
              <!--header-->
              <div
                class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t"
              >
                <h3 class="text-3xl font-semibold" v-if="editMode == false">{{ __('create') }} Theme</h3>
                <h3 class="text-3xl font-semibold" v-else>{{ __('update') }} Theme</h3>
                <button
                  class="p-1 ml-auto bg-transparent border-0 text-gray-300 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                  @click="closeModal()"
                >
                  <span
                    class="bg-transparent h-6 w-6 text-2xl block outline-none focus:outline-none"
                  >
                    <i class="fas fa-times"></i>
                  </span>
                </button>
              </div>
              <!--body-->
              <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                <div class="col-span-3 sm:col-span-2">
                  <label for="company_website" class="block text-xl font-medium text-gray-700">Name</label>
                  <div class="mt-1 flex rounded-md shadow-sm">
                    <span
                      class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-xl"
                    >Name</span>
                    <input
                      type="text"
                      v-model="form.title"
                      name="company_website"
                      :class="errors.title ? 'border-red-500' :'' "
                      id="company_website"
                      class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-xl border-gray-300"
                    />
                  </div>
                  <p class="text-red-500 text-xl italic" v-if="errors.title">{{ errors.title }}</p>
                </div>

                <div class="col-span-3 sm:col-span-2">
                  <label for="company_website" class="block text-xl font-medium text-gray-700">Link Code</label>
                  <div class="mt-1 flex rounded-md shadow-sm">
                    <span
                      class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-xl"
                    >Link Code</span>
                    <input
                      type="text"
                      v-model="form.link_code"
                      name="company_website"
                      :class="errors.link_code ? 'border-red-500' :'' "
                      id="company_website"
                      class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-xl border-gray-300"
                    />
                  </div>
                  <p
                    class="text-red-500 text-xl italic"
                    v-if="errors.link_code"
                  >{{ errors.link_code }}</p>
                </div>
             
                <div>
                  <label class="block text-xl font-medium text-gray-700">Image Theme</label>
                  <div
                    :class="errors.image_template ? 'border-red-500' :'' "
                    class="relative h-40 rounded-lg border-dashed border-2 border-gray-200 bg-white flex justify-center items-center hover:cursor-pointer"
                  >
                    <div class="absolute">
                      <div class="flex flex-col items-center">
                        <i class="fa fa-cloud-upload fa-3x text-gray-200"></i>
                        <span class="block text-gray-400 font-normal">Drag file here</span>
                        <span class="block text-gray-400 font-normal">or</span>
                        <span class="block text-blue-400 font-normal">Browse files</span>
                      </div>
                    </div>

                    <input
                      @change="onFileChangeThumb"
                      type="file"
                      class="h-full w-full opacity-0"
                      @input="form.image_template = $event.target.files[0]"
                      accept=".jpg, .jpeg, .png"
                    />
                  </div>
                  <div class="text-red-500" v-if="errors.image_template">{{ errors.image_template }}</div>

                  <div class="flex justify-between items-center text-gray-400">
                    <span>Accepted file type:.jpg, .jpeg, .png only</span>
                    <span class="flex items-center">
                      <i class="fa fa-lock mr-1"></i> secure
                    </span>
                  </div>
                  <div class="file-upload-image w-20 h-20">
                    <img v-if="thumb" :src="thumb" />
                  </div>
                </div>
              </div>
              <!--footer-->
              <div
                class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b"
              >
                <button
                  class="inline-block px-3 py-2 mr-1 mb-1 bg-red-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                  type="button"
                  @click="closeModal()"
                >{{ __('cancel') }}</button>
                <button
                  class="inline-block px-3 py-2 mr-1 mb-1 bg-blue-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-blue-600 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                  type="submit"
                  v-if="editMode == false"
                  @click.prevent="save"
                >
                  {{ __('save')
                  }}
                </button>
                <button
                  class="inline-block px-3 py-2 mr-1 mb-1 bg-blue-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-blue-600 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                  type="submit"
                  v-else
                  @click.prevent="update"
                >{{ __('update') }}</button>
              </div>
            </div>
          </div>
        </div>
        <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
      </form>
    </div>
  </div>
</template>

<script>
import Icon from "@/Components/Icon";
import PageModal from "@/Components/Modal/PageModal";
import Layout from "@/Components/Layout/Layout";
import { Link } from "@inertiajs/inertia-vue";
export default {
  layout: Layout,
  components: {
    PageModal,
    Icon,
    Link
  },
  props: {
    errors: Object
  },
  data() {
    return {
      editMode: false,
      showModal: false,
      thumb: null,
      form: this.$inertia.form({
        id: null,
        title: null,
        link_code: null,
        image_template: null,
        type: 0
      })
    };
  },
  mounted() {
    var self = this;
    Bus.$on("onAddTheme", () => {
      this.editMode = false;
      this.reset();
      this.toggleModal();
    });
    Bus.$on("onEditTheme", data => {
      this.edit(data);
    });
  },

  methods: {
    toggleModal: function() {
      this.showModal = !this.showModal;
    },
    closeModal: function() {
      this.showModal = false;
      this.reset();
      this.editMode = false;
    },
    edit: function(data) {
      this.editMode = true;
      this.form.id = data.id;
      this.form.title = data.title;
      this.form.link_code = data.link_code;
      this.form.type = data.type;
      this.toggleModal();
    },

    save() {
      this.form.post(this.route("themes.store"), {
        preserveState: true,

        onError: errors => {
          if (Object.keys(errors).length > 0) {
            this.showModal = true;
            this.editMode = false;
          }
        },
        onSuccess: page => {
          this.showModal = false;
          this.editMode = false;
          this.reset();
        }
      });
      this.reset();
    },
    reset: function() {
      this.form = this.$inertia.form({
        id: null,
        title: null,
        link_code: null,
        image_template: null,
        type: 0
        // audio360: null
      });
    },
    update() {
      this.form.post(this.route("themes.update", this.form.id), {
        preserveState: true,
        onError: errors => {
          if (Object.keys(errors).length > 0) {
            this.showModal = true;
            this.editMode = true;
          }
        },
        onSuccess: page => {
          this.showModal = false;
          this.editMode = false;
          this.reset();
        }
      });
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