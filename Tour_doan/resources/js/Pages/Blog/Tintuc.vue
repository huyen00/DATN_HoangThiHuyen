<template>
  <div class="mt-10 sm:mt-0">
    <h3 class="font-medium leading-tight text-3xl mt-0 mb-2 text-blue-600 flex">
      <icon name="new" class="w-8 h-8" />
      <span>News</span>
    </h3>
    <div class="mb-1 mt-4 flex justify-between items-center">
      <div class="flex items-center justify-end">
        <Link
          :href="route('tintuc.create')"
          class="flex items-center bg-gray-500 text-white active:bg-pink-600 font-sans text-xl px-4 py-1.5 rounded shadow-md hover:bg-gray-700 hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
          data-toggle="tooltip"
          data-placement="bottom"
          title="New"
        >
          <icon class="w-6 h-6" name="create" />
          <icon class="w-4 h-4" name="new" />
        </Link>
        <Link
          class="flex items-center bg-gray-500 text-white active:bg-pink-600 font-sans text-xl px-4 py-1.5 rounded shadow-md hover:bg-gray-700 hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
          data-toggle="tooltip"
          data-placement="bottom"
          title="Tags"
          :href="route('tag.index')"
        >
          <icon class="w-6 h-6" name="create" />
          <icon class="w-5 h-5" name="tag" />
        </Link>
        <Link
          :href="route('theloai.index')"
          class="flex items-center bg-gray-500 text-white active:bg-pink-600 font-sans text-xl px-4 py-1.5 rounded shadow-md hover:bg-gray-700 hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
          data-toggle="tooltip"
          data-placement="bottom"
          title="Thể Loại"
        >
          <icon class="w-6 h-6" name="create" />
          <icon class="w-5 h-5" name="theloai" />
        </Link>
      </div>
    </div>

    <div class="mb-6 flex flex-wrap justify-center md:mb-8 md:justify-between">
      <form
        class="relative search-form mt-5 h-[40px] w-full rounded-full bg-grey-400 md:mt-0 md:w-52"
      >
        <span
          class="z-10 h-full mr-1 leading-snug font-normal absolute text-center text-blueGray-300 bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"
        >
          <i class="fas fa-search"></i>
        </span>
        <input
          v-model="term"
          @keyup="search"
          type="text"
          placeholder="Search here..."
          class="border-0 px-5 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-xl shadow outline-none focus:outline-none focus:ring w-full pl-10"
        />
      </form>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-xl text-left text-gray-500 dark:text-gray-400">
        <thead
          class="text-xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="px-6 py-3">STT</th>
            <th scope="col" class="px-6 py-3">{{__('category')}}</th>
            <th scope="col" class="px-6 py-3">{{__('title')}}</th>
            <th scope="col" class="px-6 py-3">{{__('sub_title')}}</th>
            <!-- <th scope="col" class="px-6 py-3">Content</th> -->
            <th scope="col" class="px-6 py-3">{{__('outstanding')}}</th>
            <th scope="col" class="px-6 py-3">Tags</th>
            <th scope="col" class="px-6 py-3">Preview</th>

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

        <tr
          v-for="(element, index) in news.data"
          :key="index"
          class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
        >
          <th
            scope="row"
            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
          >{{index +1}}</th>
          <td class="px-6 py-4">
            <span
              class="text-xl inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-blue-400 text-white rounded-full"
            >{{element.category.name}}</span>
          </td>
          <td class="px-6 py-4 crop-content">{{__(element.title)}}</td>
          <td class="px-6 py-4 crop-content">{{__(element.slug)}}</td>

          <!-- <td class="px-6 py-4 crop-content" v-html="__(element.NoiDung)"></td> -->
          <td class="px-6 py-4 crop-content">
            <icon v-if="element.outstanding ==1" name="check" />
          </td>
          <td class="px-6 py-4">
            <span
              v-for="(tag,index) in element.tags"
              :key="index"
              class="flex felx-wrap mt-1 text-xl inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-200 text-gray-700 rounded-full"
            >
              <icon name="tag" />
              {{tag.name}}
            </span>
          </td>
          <td class="px-6 py-4 crop-content">
            <a
              :href="route('tintuc.preview', __(element.slug))"
              target="_blank"
              class="text-blue-500"
            >Preview</a>
          </td>
          <td class="px-6 py-4 crop-content">
            <img width="300" height="150" :src="element.image" alt="Card image cap" />
          </td>

          <td class="px-6 py-4">
            <Link
              :href="route('tintuc.edit',element.id)"
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
      </table>
    </div>
    <pagination class="mt-6" :links="news.links" />
  </div>
</template>

<script>
import Icon from "@/Components/Icon";

import Layout from "@/Components/Layout/Layout";
import { Link } from "@inertiajs/inertia-vue";
import draggable from "vuedraggable";
import Pagination from "@/Components/Pagination";
export default {
  layout: Layout,
  components: {
    Link,
    Icon,
    draggable,
    Pagination
  },
  props: {
    news: Object,
    errors: Object
  },
  data() {
    return {
      term: null
    };
  },
  methods: {
    onDelete(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(this.route("tintuc.delete", id));
    },
    search() {
      this.$inertia.get(
        this.route("tintuc.index", { term: this.term }),
        {},
        { preserveState: true }
      );
    }
  }
};
</script>

<style>
.crop-content {
  max-width: 120px;
  overflow-x: auto;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>