<template>
  <section class="content">
    <ContentHeaderVue :name="'Theme'" />
    <alert :dismissible="true"></alert>
    <div class="row mt-4">
      <h3 class="font-medium leading-tight text-3xl mt-0 mb-2 text-blue-600 flex">
        <icon name="theme" class="w-8 h-8" />
        <span>Theme</span>
      </h3>
      <div class="mb-1 mt-4 flex justify-between items-center">
        <div class="flex items-center justify-end">
          <button
            class="flex items-center bg-gray-500 text-white active:bg-pink-600 font-sans text-xl px-4 py-1.5 rounded shadow-md hover:bg-gray-700 hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
            @click="onAdd()"
          >
            <icon class="w-6 h-6" name="create" />Add
          </button>
        </div>
      </div>
      <ModalTheme :errors="errors" />

      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-xl text-left text-gray-500 dark:text-gray-400">
          <thead
            class="text-xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
          >
            <tr>
              <th scope="col" class="px-6 py-3">STT</th>
              <th scope="col" class="px-6 py-3">Name</th>
              <th scope="col" class="px-6 py-3">
                <icon name="image" class="items-center" />
              </th>
              <th scope="col" class="px-6 py-3">
                <icon name="link" class="items-center" />
              </th>
              <th scope="col" class="px-6 py-3">Type</th>

              <th scope="col" class="px-6 py-3">
                {{
                __("action")
                }}
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(element, index) in themes"
              :key="index"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
            >
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
              >{{index +1}}</th>
              <td class="px-6 py-4">
                <Link></Link>
                {{element.title}}
              </td>

              <td class="px-6 py-4">
                <img
                  v-if="element.image_template"
                  class="w-50 h-20"
                  :src="element.image_template"
                  alt="Card image cap"
                />
              </td>
              <td class="px-6 py-4">{{element.link_code}}</td>
              <td class="px-6 py-4">
                <span
                  v-if="element.type==0"
                  class="text-xl inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-800 text-white rounded-full"
                >No Category Content</span>
                <span
                  v-else-if="element.type==1"
                  class="text-xl inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-800 text-white rounded-full"
                >Category Content</span>
                <span
                  v-else-if="element.type==2"
                  class="text-xl inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-800 text-white rounded-full"
                >News</span>
                <!-- <span
                v-else-if="element.type==3"
                class="text-xl inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-800 text-white rounded-full"
                >Blog(Category )</span>-->
              </td>
              <td class="px-6 py-4">
                <a
                  @click="onEdit(element)"
                  class="inline-block px-4 py-1.5 bg-gray-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                >
                  <icon name="edit" />
                </a>

                <a
                  @click="onDelete(element.id)"
                  class="inline-block px-4 py-1.5 bg-red-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                >
                  <icon name="delete" />
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</template>

<script>
import ContentHeaderVue from "@/Components/Layout/ContentHeader";
import Alert from "@/Components/Alert";
import Icon from "@/Components/Icon";
import ModalTheme from "./ModalTheme";
import Layout from "@/Components/Layout/Layout";
import { Link } from "@inertiajs/inertia-vue";

export default {
  layout: Layout,
  components: {
    ModalTheme,
    Icon,
    Link,
    ContentHeaderVue,
    Alert
  },
  props: {
    themes: Array,
    errors: Object
  },
  data() {
    return {};
  },
  methods: {
    onDelete(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(this.route("themes.delete", id), {
        preserveState: false
      });
    },
    onAdd() {
      Bus.$emit("onAddTheme");
    },
    onEdit(element) {
      Bus.$emit("onEditTheme", element);
    }
  }
};
</script>

<style>
</style>