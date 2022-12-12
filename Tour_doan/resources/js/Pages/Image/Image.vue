<template>
      <section class="content">
    <!-- <ContextMenu /> -->

    <ContentHeaderVue :name="'Page'" />
    <alert :dismissible="true"></alert>

  <div class="mt-20 sm:mt-0">
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
            <th scope="col" class="px-6 py-3">
              {{
              __("action")
              }}
            </th>
          </tr>
        </thead>
        <draggable
          v-model="content.images"
          tag="tbody"
          @change="onUnpublishedChange"
          v-bind="dragOptions"
          @start="isDragging = true"
          @end="isDragging = false"
          item-key="id_priority"
        >
          <template>
            <tr
              v-for="(element, index) in content.images"
              :key="index"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
            >
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
              >{{index +1}}</th>

              <td class="px-6 py-4">{{element.name}}</td>

              <td class="px-6 py-4 crop-content">
                <img
                  v-if="element.image"
                  class="w-50 h-20"
                  :src="element.image"
                  alt="Card image cap"
                />
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

import ModalImage from "./ModalImage";
export default {
  props: {
    content: Object,
    errors: Object
  },
  components: {
    draggable,
    Link,
    Icon,
    ModalImage,
    Alert,
    ContentHeaderVue,
    BreadCrumb
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
  data() {
    return {
      form: this.$inertia.form({
        id: null,
        name: null,
        images: null
      }),
    
    };
  },
  methods: {
    onUnpublishedChange() {
      let query = {
        data: this.content.images
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
    }
  }
};
</script>

<style>
</style>