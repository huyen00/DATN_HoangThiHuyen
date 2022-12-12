<template>
  <section class="content">
    <Head title="Content"></Head>
    <ContentHeaderVue :name="'Content'" :icon="'fa fa-picture-o'" />
    <alert :dismissible="true"></alert>
    <BreadCrumb :crumbs="crumbs" />
    <ModalVoice :errors="errors" :content="content" :category_voices="category_voices" :google_voices="google_voices"  />
    <button
      type="button"
      class="inline-block px-8 py-4 bg-blue-600 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
      data-toggle="modal"
      data-target="#exampleModal"
      @click="onAdd()"
    >Create Voice</button>

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
                  >Voice</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Type</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Type Voice</th>
                    <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Active</th>
   

                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody  class="bg-white divide-y divide-gray-200">
                <tr v-for="(voice,index) in  voices" :key="index">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="ml-4">
                        <div class="text-xl font-medium text-gray-900">{{ index }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">{{ voice.name }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <audio  
                        style="width: 100px"
                        controls
                      >
                        <source :src="voice.voice" />
                      </audio>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900"><span v-if="voice.type =='Google'" class="text-xl inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-blue-600 text-white rounded-full">{{ voice.type }}</span>
                      <span v-if="voice.type =='Viettel'" class="text-xl inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-600 text-white rounded-full">{{ voice.type }}</span></div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900"><span class="bg-blue-100 text-blue-800 text-2xl font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{ voice.type_voice }}</span></div>
                  </td>
                    <td class="px-6 py-4 crop-content">
                    <input
                            :checked="voice.state == 1 ? true : false"
                            @change="onChangeActive(voice, $event)"
                            class="toggle-class-public"
                            type="checkbox"
                        />
                    </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button
                      data-toggle="modal"
                      data-target="#exampleModal"
                      class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                      @click="onEdit(voice)"
                    >Update</button>
                    <button
                      @click="deleteRow(voice.id)"
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
import ModalVoice from "./ModalVoice";
export default {
  layout: Layout,
  components: {
    Link,
    ContentHeaderVue,
    Pagination,
    Alert,
    BreadCrumb,
    Head,
    ModalVoice
  },
  props: {
    pano: Object,
    tour: Object,
    errors: Object,
    hotspot: Object,
    content: Object,
    category_voices: Array,
    google_voices:Array,
    voices:Array
  },
  data() {
    return {
      editMode: false,
      image: null,
      form: this.$inertia.form({
        id: null
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
          name: this.pano.name
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
        },
        {
          route: "tour.voice.index",
          parma: [this.content.id],
          name: this.content.name
        },
        {
          route: "tour.voice.index",
          parma: [this.content.id],
          name: "Voice"
        }
      ]
    };
  },
  methods: {
    deleteRow(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(route("tour.voice.delete", id));
    },
    onAdd() {
      Bus.$emit("onAddVoice");
    },
    onEdit(element) {
      Bus.$emit("onEditVoice", element);
    },
    onChangeActive(data, event) {
      let query = {
        id: data.id,
        voices: this.content.voices
      };
      this.$inertia.post(route("tour.voice.selectVoice"), query, {
        preserveState: false
        // only: ["image360s", "errors", 'flash'],
      });
    }
  }
};
</script>

<style>
</style>