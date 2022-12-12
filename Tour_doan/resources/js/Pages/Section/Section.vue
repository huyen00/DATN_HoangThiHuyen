<template>
  <section class="content">
    <!-- <ContextMenu /> -->

    <ContentHeaderVue :name="'Page'" />
    <alert :dismissible="true"></alert>
    <div class="mt-10 sm:mt-0">
      <div class="mb-1 mt-4 flex justify-between items-center">
        <div class="flex items-center justify-end">
          <Link
            :href="route('section.create', page.id)"
            class="flex items-center bg-gray-500 text-white active:bg-pink-600 font-sans text-xl px-6 py-1.5 rounded shadow-md hover:bg-gray-700 hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
          >
            <icon class="w-6 h-6" name="create" />Add
          </Link>
        </div>
      </div>
      <BreadCrumb :crumbs="crumbs" />
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-10">
        <table class="w-full text-xl text-left text-gray-500 dark:text-gray-400">
          <thead
            class="text-xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
          >
            <tr>
              <th scope="col" class="px-6 py-3">STT</th>
              <th scope="col" class="px-6 py-3">{{__('title')}}</th>
              <th scope="col" class="px-6 py-3">{{__('sub_title')}}</th>
              <th scope="col" class="px-6 py-3">{{__('description')}}</th>
              <th scope="col" class="px-6 py-3">Theme</th>
              <th scope="col" class="px-6 py-3">Active</th>
              <th scope="col" class="px-6 py-3">
                {{
                __("action")
                }}
              </th>
            </tr>
          </thead>

          <draggable
            v-model="sections"
            tag="tbody"
            @change="onUnpublishedChange"
            v-bind="dragOptions"
            @start="isDragging = true"
            @end="isDragging = false"
            item-key="id_priority"
          >
            <template>
              <tr
                v-for="(element, index) in sections"
                :key="index"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
              >
                <th
                  scope="row"
                  class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                >{{index +1}}</th>

                <td class="px-6 py-4 crop-content">{{__(element.title)}}</td>
                <td class="px-6 py-4 crop-content">{{__(element.sub_title)}}</td>

                <td v-if="element.description" class="px-6 py-4 crop-content">
                  <span v-html="__(element.description)"></span>
                </td>
                <td v-else class="px-6 py-4 crop-content"></td>
                <td class="px-6 py-4 crop-content">
                  <img
                    v-if="element.theme.image_template"
                    class="w-50 h-20"
                    :src="element.theme.image_template"
                    alt="Card image cap"
                  />
                </td>
                <td class="px-6 py-4 crop-content">
                  <input
                    :checked="element.active == 1 ? true : false"
                    @change="onChangeActive(element, $event)"
                    class="toggle-class-public"
                    type="checkbox"
                  />
                </td>
                <td class="px-6 py-4">
                  <Link
                    v-if="element.theme.type ==0 "
                    data-toggle="tooltip"
                    data-placement="bottom"
                    title="Contents"
                    :href="route('content.index',element.title)"
                    class="inline-block px-6 py-1.5 bg-gray-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                  >
                    <icon name="content" />
                  </Link>

                  <Link
                    v-if="element.theme.type ==2 "
                    data-toggle="tooltip"
                    data-placement="bottom"
                    title="Contents"
                    :href="route('tintuc.index')"
                    class="inline-block px-6 py-1.5 bg-gray-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                  >
                    <icon name="content" />
                  </Link>

                  <Link
                    v-if="element.theme.type ==1 ||element.theme.type ==3"
                    data-toggle="tooltip"
                    data-placement="bottom"
                    title="Categrory Content"
                    :href="route('category.index',element.title)"
                    class="inline-block px-6 py-1.5 bg-gray-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                  >
                    <icon name="content" />
                  </Link>
                  <Link
                    :href="route('section.edit',element.id)"
                    class="inline-block px-6 py-1.5 bg-gray-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                  >
                    <icon name="edit" />
                  </Link>

                  <a
                    @click="onDelete(element.id)"
                    class="inline-block px-6 py-1.5 bg-red-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
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
export default {
  layout: Layout,
  components: {
    Icon,
    Link,
    draggable,
    ContentHeaderVue,
    Alert,
    BreadCrumb
  },
  props: {
    page: Object,
    themes: Array,
    sections: Array,
    errors: Object
  },
  data() {
    return {
      form: this.$inertia.form({
        id: null,
        name: null
      }),
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
      this.$inertia.delete(this.route("section.delete", id));
    },
    onUnpublishedChange() {
      let query = {
        data: this.sections
      };
      this.$inertia.post(this.route("section.priority"), query, {
        preserveState: false
      });
    },
    onChangeActive(data, event) {
      if (event.target.checked) {
        this.form.active = 1;
      } else {
        this.form.active = 0;
      }
      let query = {
        id: data.id,
        active: this.form.active
      };
      axios
        .post("/changeActiveSection", query)
        .then(response => {
          setTimeout(() => {
            this.$toast.success(response.data, {
              position: "bottom-right",
              duration: 3000
            });
          }, 1000);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
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