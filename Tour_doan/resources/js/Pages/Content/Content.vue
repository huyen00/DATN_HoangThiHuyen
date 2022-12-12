<template>
  <section class="content">
    <!-- <ContextMenu /> -->

    <ContentHeaderVue :name="'Page'" />
    <alert :dismissible="true"></alert>
  <div class="mt-10 sm:mt-0">

    <div class="mb-1 mt-4 flex justify-between items-center">
      <div class="flex items-center justify-end">
        <Link
          :href="route('content.create', section.title)"
          class="flex items-center bg-gray-500 text-white active:bg-pink-600 font-sans text-xl px-4 py-1.5 rounded shadow-md hover:bg-gray-700 hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
          
        >
          <icon class="w-6 h-6" name="create" />Add
        </Link>
      </div>
    </div>
    <BreadCrumb :crumbs="crumbs" />
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-xl text-left text-gray-500 dark:text-gray-400">
        <thead
          class="text-xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="px-6 py-3">STT</th>
            <th scope="col" class="px-6 py-3">{{__('title')}}</th>
            <th scope="col" class="px-6 py-3">{{__('sub_title')}}</th>
            <th scope="col" class="px-6 py-3">{{__('description')}}</th>
            <th scope="col" class="px-6 py-3">Link</th>
            <th scope="col" class="px-6 py-3">
              <icon name="image" />
            </th>
            <th scope="col" class="px-6 py-3">Icon</th>
            <th scope="col" class="px-6 py-3">Video</th>

            <th scope="col" class="px-6 py-3">
              {{
              __("action")
              }}
            </th>
          </tr>
        </thead>
        <draggable
          v-model="section.page_contents"
          tag="tbody"
          @change="onUnpublishedChange"
          v-bind="dragOptions"
          @start="isDragging = true"
          @end="isDragging = false"
          item-key="id_priority"
        >
          <template>
            <tr
              v-for="(element, index) in section.page_contents"
              :key="index"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
            >
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
              >{{index +1}}</th>

              <td class="px-6 py-4">
                  {{__(element.title)}}
              </td>
              <td class="px-6 py-4 crop-content">{{__(element.sub_title)}}</td>

              <td class="px-6 py-4 crop-content" v-html="__(element.description)"></td>
              <td class="px-6 py-4 crop-content">{{element.link}}</td>
              <td class="px-6 py-4 crop-content">
                <img
                  v-if="element.images.length >0"
                  class="w-50 h-20"
                  :src="element.images[0].image"
                  alt="Card image cap"
                />
              </td>
              <td class="px-6 py-4 crop-content">
                <img
                  v-if="element.image"
                  class="w-6 h-6 bg-gray-500"
                  :src="element.image"
                  alt="Card image cap"
                />
              </td>
              <td class="px-6 py-4 crop-content">
                <iframe
                  v-if="element.video"
                  width="90"
                  height="160"
                  :src="'https://www.youtube.com/embed/'+element.video"
                ></iframe>
              </td>
              <td class="px-6 py-4">
                <Link
                  
                  :href="route('image.index',element.id)"
                  class="inline-block px-4 py-1.5 bg-gray-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                >
                  <icon name="image" />
                </Link>

                <Link
                  
                  :href="route('content.edit',element.id)"
                  class="inline-block px-4 py-1.5 bg-gray-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                >
                  <icon name="edit" />
                </Link>

                <a
                  
                  @click="onDelete(element.id)"
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
import BreadCrumb from "@/Pages/Tour/BreadCrumb";
import Alert from "@/Components/Alert";
import Icon from "@/Components/Icon";
import Layout from "@/Components/Layout/Layout";
import { Link } from "@inertiajs/inertia-vue";
import draggable from "vuedraggable";
export default {
  layout: Layout,
  components: {
    Link,
    Icon,
    draggable,
    BreadCrumb,
    ContentHeaderVue,
    Alert
  },
  props: {
    page: Object,
    section: Object
  },
  data() {
    return {
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
        }
      ]
    };
  },
  computed: {
    dragOptions() {
      return {
        animation: 100,
        group: "description",
        disabled: false,
        ghostClass: "ghost"
      };
    }
  },
  methods: {
    onDelete(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(this.route("content.delete", id));
    },
    onUnpublishedChange() {
      let query = {
        data: this.section.page_contents
      };
      this.$inertia.post(this.route("content.priority"), query, {
        preserveState: false
      });
    }
  }
};
</script>

<style>
</style>