<template>
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
            <h5 class="modal-title" id="exampleModalLabel" v-if="editMode">Update Voice</h5>
            <h5 class="modal-title" id="exampleModalLabel" v-else>Create Voice</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="save">
              <div class="px-4 py-5 bg-white space-y-6 xl:p-6">
                <div class="col-span-3 sm:col-span-3">
                  <label for="company_website" class="block text-xl font-medium text-gray-700">Name</label>
                  <div class="mt-1 flex rounded-md shadow-sm">
                    <span
                      class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-xl"
                    >Name</span>
                    <input
                      type="text"
                      v-model="form.name"
                      name="company_website"
                      :class="errors.name ? 'border-red-500' :'' "
                      id="company_website"
                      class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-xl border-gray-300"
                    />
                  </div>
                  <p class="text-red-500 text-xl italic" v-if="errors.name">{{ errors.name }}</p>
                </div>

                <div class="col-span-3 sm:col-span-2">
                  <label class="block text-xl font-medium text-gray-700">Type Api</label>
                  <div class="flex">
                    <select
                      id="countries"
                      v-model="form.type"
                      :class="errors.type ? 'border-red-500' :''"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                      <option value="Google">GoogleApi</option>
                      <option value="Viettel">VietelApi</option>
                    </select>
                    <div class="text-red-500" v-if="errors.type">{{ errors.type }}</div>
                  </div>
                </div>
                <div class="col-span-3 sm:col-span-2" v-if="form.type=='Viettel'">
                  <label class="block text-xl font-medium text-gray-700">Giọng Đọc</label>
                  <div class="flex">
                    <select
                      id="countries"
                      v-model="form.type_voice"
                      :class="errors.type_voice ? 'border-red-500' :''"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                      <option v-for="(category,index) in category_voices" :key="index" :value="category.code"> {{category.description}} {{category.name}}</option>
            
                    </select>

                    <div class="text-red-500" v-if="errors.type_voice">{{ errors.type_voice }}</div>
                  </div>
                </div>

                <div class="col-span-3 sm:col-span-2" v-if="form.type=='Google'">
                  <label class="block text-xl font-medium text-gray-700">Language</label>
                  <div class="flex">
                    <select
                      id="countries"
                      v-model="form.type_voice"
                      :class="errors.type_voice ? 'border-red-500' :''"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                      <option v-for="(language,index) in google_voices" :key="index" :value="language.code"> {{language.name}} </option>
            
                    </select>

                    <div class="text-red-500" v-if="errors.type_voice">{{ errors.type_voice }}</div>
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
</template>

<script>
import Icon from "@/Components/Icon";
import { Link } from "@inertiajs/inertia-vue";
export default {
  components: {
    Icon,
    Link
  },
  props: {
    errors: Object,
    category_voices:Array,
    infor:Object,
    tour:Object,
    google_voices:Array,
  },
  data() {
    return {
      editMode: false,
      showModal: false,
      thumb: null,
      form: this.$inertia.form({
        id: null,
        type: null,
        name: null,
        type_voice: null
      })
    };
  },
  mounted() {
    var self = this;
    Bus.$on("onAddVoice",() => {
      this.editMode = false;
      this.reset();
      this.toggleModal();
    });
    Bus.$on("onEditVoice", data => {
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
      this.form.name = data.name;
      this.form.type_voice = data.type_voice;
      this.form.type = data.type;
     
      this.toggleModal();
    },

    save() {
      if(this.editMode){
        this.form.post(this.route("tour.infor.voices.update", [this.infor.id,this.form.id]), {
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
          $("#exampleModal").modal("hide");
          this.reset();
        }
      });
      }else{
        this.form.post(this.route("tour.infor.voices.store", [this.tour.id, this.infor.id]), {
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
          $("#exampleModal").modal("hide");
          this.reset();
        }
      });
      }
     
     
    },
    reset: function() {
      this.form = this.$inertia.form({
        id: null,
        type: null,
        name: null,
        type_voice: null
      });
    },

  }
};
</script>

<style>
</style>