<template>
  <div class="mt-10 sm:mt-0 overflow-auto">
     
    <h1 class="mt-2"><i class="fa fa-newspaper-o"></i></i>   {{__('create')}} {{__('news')}}</h1>


    <div class="md:mt-0 md:col-span-3 mt-8">
      <form @submit.prevent="save">
        <div class="shadow overflow-hidden sm:rounded-md">
          <div class="px-4 py-5 bg-white sm:p-6">
          <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-2" >
                <label for="country" class="block text-xl font-medium text-gray-700">Tags</label>
                   <Multiselect v-model="form.tags" mode="tags" :appendNewTag="false" :createTag="false"
                    :searchable="true" label="name" valueProp="id" trackBy="name" :options="tags"
                    class="multiselect-blue" />

                <div class="text-red-500" v-if="errors.tags">{{ errors.tags }}</div>
            </div>
            <div class="col-span-6 sm:col-span-2" >
                <label for="country" class="block text-xl font-medium text-gray-700">{{__('category')}}</label>
               <select
                     class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-xl border-gray-300 rounded-md"
                    id="grid-state"
                    v-model="form.category_id"
                  >
                    <option
                      v-for="(category, index) in category_news"
                      :key="index"
                      :value="category.id"
                    >{{ category.name }}</option>
                  </select>
                <div class="text-red-500" v-if="errors.category_id">{{ errors.category_id }}</div>
            </div>
            <div class="col-span-6 sm:col-span-2" >
                <label for="country" class="block text-xl font-medium text-gray-700">Image</label>
                <input
                  @input="form.image  = $event.target.files[0]"
                  type="file"
                  name="email_address"
                  id="email_address"
                  placeholder="Title VietNamese"
                  autocomplete="Image"
                  accept=".png, .jpeg, .jpg"
                  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-xl border-gray-300 rounded-md"
                />
                <div class="text-red-500" v-if="errors.image">{{ errors.image }}</div>
              </div>
          </div>
           

            <div class="grid grid-cols-6 gap-6 mt-4">
           

              <div class="col-span-6 sm:col-span-2" >
                <label
                  for="email_address"
                  class="block text-xl font-medium text-gray-700"
                >{{__('title')}} {{__('en')}}</label>
                <input
                  v-model="form.title_en"
                  type="text"
                  name="email_address"
                  id="email_address"
                  autocomplete="email"
                  placeholder="Title English"
                  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-xl border-gray-300 rounded-md"
                />
                <div class="text-red-500" v-if="errors.title_en">{{ errors.title_en }}</div>
              </div>

              <div class="col-span-6 sm:col-span-2" >
                <label
                  for="country"
                  class="block text-xl font-medium text-gray-700"
                >{{__('title')}} {{__('vn')}}</label>
                <input
                  v-model="form.title_vn"
                  type="text"
                  name="email_address"
                  id="email_address"
                  placeholder="Title VietNamese"
                  autocomplete="email"
                  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-xl border-gray-300 rounded-md"
                />
                <div class="text-red-500" v-if="errors.title_vn">{{ errors.title_vn }}</div>
              </div>

                  <div class="col-span-6 sm:col-span-2" >
                <label
                  for="street_address"
                  class="block text-xl font-medium text-gray-700"
                >{{__('outstanding')}}</label>
                <div class="mt-1">
                      <input
                        type="radio"
                        v-model="form.outstanding"
                        name="inlineRadioOptions"
                        id="inlineRadio1"
                        value="0"
                        class="form-check-input form-check-input ml-2 appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                      />
                         <div class="ml-2 text-xl">
                        <span
                          for="helper-checkbox"
                          class="font-medium text-gray-900 dark:text-gray-300"
                        >No</span>
                      </div>
                       <input
                        type="radio"
                        v-model="form.outstanding"
                        name="inlineRadioOptions"
                        id="inlineRadio1"
                        value="1"
                        class="form-check-input form-check-input ml-2 appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                      />
                         <div class="ml-2 text-xl">
                        <span
                         
                          for="helper-checkbox"
                          class="font-medium text-gray-900 dark:text-gray-300"
                        >Yes</span>
                      </div>
                </div>
                <div class="text-red-500" v-if="errors.outstanding">{{ errors.outstanding }}</div>
              </div>

              <div class="col-span-6 sm:col-span-2" >
                <label
                  for="street_address"
                  class="block text-xl font-medium text-gray-700"
                >{{__('content')}} {{__('en')}}</label>
                <div class="mt-1">
                   <ckeditor
                      v-model="form.content_en"
                    :config="editorConfig"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-xl border-gray-300 rounded-md"
                    placeholder="Description VietNamese"
                  ></ckeditor>
                </div>
                <div class="text-red-500" v-if="errors.content_en">{{ errors.content_en }}</div>
              </div>
              <div class="col-span-6 sm:col-span-2" >
                <label
                  for="street_address"
                  class="block text-xl font-medium text-gray-700"
                >{{__('content')}} {{__('vn')}}</label>
                <div class="mt-1">
                  <ckeditor
                    v-model="form.content_vn"
                    :config="editorConfig2"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-xl border-gray-300 rounded-md"
                    placeholder="Description VietNamese"
                  ></ckeditor>
                </div>
                <div class="text-red-500" v-if="errors.content_vn">{{ errors.content_vn }}</div>
              </div>

          
              
            
              
            </div>
          </div>
          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
          
            <Link
              
              :href="route('tintuc.index')"
              class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-xl font-medium rounded-md text-gray-800 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
            >Back</Link>
            <button
            
              type="submit"
              class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-xl font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Multiselect from "@vueform/multiselect/dist/multiselect.vue2.js";
import Icon from "@/Components/Icon";
import Layout from "@/Components/Layout/Layout";
import { Link } from "@inertiajs/inertia-vue";

export default {
  layout: Layout,
  props: {
    tags: Array,
    category_news: Array,
    errors: Object
  },
  components: {
    Link,
    Icon,
    Multiselect
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
      form: this.$inertia.form({
        id: null,
        title_en: null,
        title_vn: null,
        content_en: null,
        content_vn: null,
        image: null,
        outstanding:0,
        tags:null,
        category_id:null

      })
    };
  },
  computed: {
   
  },

  methods: {
    save() {
      this.form.post(this.route("tintuc.store"), {
        preserveState: true,

        onError: errors => {
          if (Object.keys(errors).length > 0) {
          }
        },
        onSuccess: page => {
          this.reset();
        }
      });
    },
    reset: function() {
      this.form = this.$inertia.form({
         id: null,
        title_en: null,
        title_vn: null,
        content_en: null,
        content_vn: null,
        image: null,
        outstanding:0,
        tags:null,
        category_id:null
      });
    }
  }
};
</script>
<style src="@vueform/multiselect/themes/default.css">
</style>
<style>
</style>