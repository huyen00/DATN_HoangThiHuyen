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
                    <i class="fa fa-times"></i>
                  </span>
                </button>
              </div>
              <!--body-->
              <div class="md:flex grid grid-rows-2 grid-flow-col gap-4">
                <div class="p-3 row-span-3" v-if="editMode == false">
                  <div class="mb-4">
                    <label>{{__('title')}} key</label>
                    <input
                      type="text"
                      v-model="form.title"
                      :class="[errors.title ?   'border-red-500' :'']"
                      class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-xl border-gray-300 rounded-md"
                    />
                    <div class="text-red-500 font-bold" v-if="errors.title">{{ errors.title }}</div>
                  </div>
                </div>
                <div class="p-3 col-span-2">
                  <div class="mb-4">
                    <label>{{__('title')}} {{__('en')}}</label>
                    <input
                      type="text"
                      v-model="form.title_en"
                      :class="[errors.title_en ?   'border-red-500' :'']"
                      class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-xl border-gray-300 rounded-md"
                    />
                    <div class="text-red-500 font-bold" v-if="errors.title_en">{{ errors.title_en }}</div>
                  </div>
                </div>
                <div class="p-3 row-span-2 col-span-2">
                  <div class="mb-4">
                    <label>{{__('title')}} {{__('vn')}}</label>
                    <input
                      type="text"
                      v-model="form.title_vn"
                      :class="[errors.title_vn ?   'border-red-500' :'']"
                      class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-xl border-gray-300 rounded-md"
                    />
                    <div class="text-red-500 font-bold" v-if="errors.title_vn">{{ errors.title_vn }}</div>
                  </div>
                </div>
              </div>
              <hr />
              <div class="md:flex grid grid-rows-2 grid-flow-col gap-4">
                <div class="p-3">
                  <div class="mb-4">
                    <label>{{__('description')}} {{__('en')}}</label>
                    <textarea
                      type="text"
                      v-model="form.description_en"
                      :class="[errors.description_en ?   'border-red-500' :'']"
                      class="form-controlblock w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    ></textarea>
                    <div
                      class="text-red-500 font-bold"
                      v-if="errors.description_en"
                    >{{ errors.description_en }}</div>
                  </div>
                </div>
                <div class="p-3">
                  <div class="mb-4">
                    <label>{{__('description')}} {{__('vn')}}</label>
                    <textarea
                      type="text"
                      v-model="form.description_vn"
                      :class="[errors.description_vn ?   'border-red-500' :'']"
                      class="form-controlblock w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    ></textarea>
                    <div
                      class="text-red-500 font-bold"
                      v-if="errors.description_vn"
                    >{{ errors.description_vn }}</div>
                  </div>
                </div>
              </div>
              <!--footer-->
              <div
                class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b"
              >
                <button
                  class="inline-block px-3 py-2 mr-1 mb-1 bg-red-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
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
      editMode: false,
      showModal: false,
      form: this.$inertia.form({
        id: null,
        title: null,
        title_en: null,
        title_vn: null,
        description: null,
        description_en: null,
        description_vn: null
      })
    };
  },
  mounted() {
    var self = this;
    Bus.$on("onAddPage", () => {
      this.editMode = false;
      this.reset();
      this.toggleModal();
    });
    Bus.$on("onEditPage", data => {
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
      const result = data.languages.find(element => element.key == data.title);
      const result2 = data.languages.find(
        element => element.key == data.description
      );
      this.form.title = data.title;
      this.form.title_en = result == undefined ? null : result.en;
      this.form.title_vn = result == undefined ? null : result.vn;
      this.form.description = data.description;
      this.form.description_en = result2 == undefined ? null : result2.en;
      this.form.description_vn = result2 == undefined ? null : result2.vn;
      this.toggleModal();
    },

    save() {
      this.form.post(this.route("pages.store"), {
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
        title_en: null,
        title_vn: null

        // audio360: null
      });
    },
    update() {
      this.form.put(this.route("pages.update", this.form.id), {
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
    }
  }
};
</script>
<style scoped>
</style>