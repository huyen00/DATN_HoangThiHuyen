<template>
  <div class="mt-10 sm:mt-0">
    <TheLoaiModal :errors="errors"></TheLoaiModal>
    <div class="mb-1 mt-4 flex justify-between items-center">
      <div class="flex items-center justify-end">
        <Link
          class="flex items-center bg-gray-500 text-white active:bg-pink-600 font-sans text-xl px-4 py-1.5 rounded shadow-md hover:bg-gray-700 hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
          
          :href="route('tintuc.index')"
        >
          <icon class="w-5 h-5" name="back" />Back
        </Link>
        <button
          class="flex items-center bg-gray-500 text-white active:bg-pink-600 font-sans text-xl px-4 py-1.5 rounded shadow-md hover:bg-gray-700 hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
          
          v-on:click="onAddClass()"
        >
          <icon class="w-5 h-5" name="create" />Add
        </button>
      </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-xl text-left text-gray-500 dark:text-gray-400">
        <thead
          class="text-xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="px-6 py-3">STT</th>
            <th scope="col" class="px-6 py-3">Name</th>
            <th scope="col" class="px-6 py-3">Slug</th>

            <th scope="col" class="px-6 py-3">
              {{
              __("action")
              }}
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(element, index) in categories"
            :key="index"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
          >
            <th
              scope="row"
              class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
            >{{index +1}}</th>
            <td class="px-6 py-4">
              {{(element.name)}}
            </td>

            <td class="px-6 py-4">{{(element.slug)}}</td>

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
</template>

<script>
import Icon from "@/Components/Icon";
import TheLoaiModal from "./TheLoaiModal";
import Layout from "@/Components/Layout/Layout";
import { Link } from "@inertiajs/inertia-vue";
export default {
  layout: Layout,
  components: {
    Icon,
    Link,
    TheLoaiModal
  },
  props: {
    categories: Array,
    errors: Object
  },
  data() {
    return {
      term: null,
      form: this.$inertia.form({
        id: null

        // start_date: null
      })
    };
  },
  methods: {
    onAddClass() {
      Bus.$emit("onAddTheLoai");
    },

    onEdit(data) {
      Bus.$emit("onEditTheLoai", data);
    },
    onDelete(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(this.route("theloai.delete", id));
    }
  }
};
</script>

<style>
</style>