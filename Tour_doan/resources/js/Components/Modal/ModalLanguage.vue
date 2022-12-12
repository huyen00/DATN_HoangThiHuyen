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
                <h3 class="text-3xl font-semibold" v-if="editMode == false">{{ __('create') }} Page</h3>
                <h3 class="text-3xl font-semibold" v-else>{{ __('update') }} Page</h3>
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
              <div class="shadow overflow-hidden sm:rounded-md">
                <div class="flex justify-center">
                  <div class="form-check form-check-inline">
                    <input
                      class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                      type="checkbox"
                      name="inlineRadioOptions"
                      id="inlineRadio1"
                      @change="onChangeEventCkEditor($event)"
                      :checked="showCkeditor  ? true : false"
                    />
                    <label
                      class="form-check-label inline-block text-gray-800"
                      for="inlineRadio10"
                    >ckeditor Mode</label>
                  </div>
                </div>
              </div>
              <!--body-->
              <div class="grid grid-cols-6 gap-6 px-3 py-3">
                <div class="col-span-6 sm:col-span-2" v-if="editMode==false">
                  <label for="street_address" class="block text-sm font-medium text-gray-700">Key</label>
                  <input
                    type="text"
                    v-model="form.key"
                    name="street_address"
                    id="street_address"
                    autocomplete="street-address"
                    placeholder="key"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                  />
                  <div class="text-red-500" v-if="errors.key">{{ errors.key }}</div>
                </div>

                <div class="col-span-6 sm:col-span-2">
                  <label
                    for="street_address"
                    class="block text-sm font-medium text-gray-700"
                  >{{__('en')}}</label>
                  <div class="mt-1">
                    <ckeditor
                      v-if="showCkeditor"
                      v-model="form.en"
                      :config="editorConfig"
                      class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                      placeholder="Description VietNamese"
                    ></ckeditor>
                    <textarea
                      v-else
                      name="ev"
                      class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                      v-model="form.en"
                      cols="20"
                      rows="5"
                    ></textarea>
                  </div>
                  <div class="text-red-500" v-if="errors.en">{{ errors.en }}</div>
                </div>
                <div class="col-span-6 sm:col-span-2">
                  <label
                    for="street_address"
                    class="block text-sm font-medium text-gray-700"
                  >{{__('vn')}}</label>
                  <div class="mt-1">
                    <ckeditor
                      v-if="showCkeditor"
                      v-model="form.vn"
                      :config="editorConfig2"
                      class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                      placeholder="Description VietNamese"
                    ></ckeditor>
                    <textarea
                      v-else
                      name="ev"
                      class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                      v-model="form.vn"
                      cols="20"
                      rows="5"
                    ></textarea>
                  </div>
                  <div class="text-red-500" v-if="errors.vn">{{ errors.vn }}</div>
                </div>
              </div>

              <!--footer-->
              <div
                class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b"
              >
                <button
                  class="inline-block px-3 py-2 mr-1 mb-1 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                 
                  @click="closeModal()"
                >{{ __('cancel') }}</button>
                <button
                  class="inline-block px-3 py-2 mr-1 mb-1 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-600 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                  type="submit"
                  v-if="editMode == false"
                  @click.prevent="save"
                >
                  {{ __('save')
                  }}
                </button>
                <button
                  class="inline-block px-3 py-2 mr-1 mb-1 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-600 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
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
export default {
  props: {
    errors: Object
  },
  components: {
    Icon,
    Notification
  },
  data() {
    return {
      editorData: "<p>Content of the editor.</p>",
      editorConfig: {
        // The configuration of the editor.
      },
      editorConfig2: {
        // The configuration of the editor.
      },
      showCkeditor: false,
      editMode: false,
      showModal: false,
      form: this.$inertia.form({
        id: null,
        key: null,
        en: null,
        vn: null
      })
    };
  },
  mounted() {
    var self = this;
    Bus.$on("onAddLanguage", () => {
      this.editMode = false;
      this.reset();
      this.toggleModal();
    });
    Bus.$on("onEditLanguage", data => {
      this.edit(data);
    });
  },

  methods: {
    toggleModal: function() {
      this.showModal = !this.showModal;
      this.showCkeditor = false;
    },
    closeModal: function() {
      this.showModal = false;
      this.reset();
      this.editMode = false;
    },
    edit: function(data) {
      this.editMode = true;
      this.form.id = data.id;
      this.form.key = data.key;
      this.form.en = data.en;
      
      if (data.en !==null && data.en[0] === "<") {
        this.showCkeditor = true;

      }
      this.form.vn = data.vn;
      this.showModal = true;
    },

    save() {
      this.form.post(this.route("languages.store"), {
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
        key: null,
        en: null,
        vn: null

        // audio360: null
      });
    },
    update() {
      this.form.put(this.route("languages.update", this.form.id), {
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
    onChangeEventCkEditor(event){
        this.showCkeditor = event.target.checked;
    }
  }
};
</script>
<style scoped>
</style>