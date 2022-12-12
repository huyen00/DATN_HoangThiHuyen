<template>
  <section class="content">
    <!-- <ContextMenu /> -->
    <ContentHeaderVue :name="'Page'" />
    <alert :dismissible="true"></alert>
    <button
            class="inline-block px-8 py-4 bg-blue-600 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
            v-on:click="onAddClass()" >
            Create Page
    </button>
    <div class="mt-10 sm:mt-0">
      <PageModal :errors="errors"></PageModal>
     
         
      </div>
      <!-- <div :class="{ shake: disabled }">
      <button @click="warnDisabled">Click me</button>
      <span v-if="disabled">This feature is disabled!</span>
      </div>-->
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-xl text-left text-gray-500 dark:text-gray-400">
          <thead
            class="text-xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
          >
            <tr>
              <th scope="col" class="px-6 py-3">STT</th>
              <th scope="col" class="px-6 py-3">{{__('title')}}</th>
              <th scope="col" class="px-6 py-3">{{__('description')}}</th>

              <th scope="col" class="px-6 py-3">
                {{
                __("action")
                }}
              </th>
            </tr>
          </thead>
          <draggable
            v-model="pages"
            tag="tbody"
            @change="onUnpublishedChange"
            v-bind="dragOptions"
            @start="isDragging = true"
            @end="isDragging = false"
            item-key="id_priority"
          >
            <template>
              <tr
                v-for="(element, index) in pages"
                :key="index"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
              >
                <th
                  scope="row"
                  class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                >{{index +1}}</th>
                <td class="px-6 py-4">
                  <Link :href="route('section.index',element.id)">{{__(element.title)}}</Link>
                </td>

                <td class="px-6 py-4">{{ __(element.description)}}</td>
                <!-- <td class="px-6 py-4">
              <Link
                data-toggle="tooltip"
                data-placement="bottom"
                title="Teams"
                :href="route('team.index',element.id)"
                
                class="inline-block px-4 py-1.5 bg-gray-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
              >
                <icon name="team" class="w-4 h-4" />
              </Link>
              <Link
                data-toggle="tooltip"
                data-placement="bottom"
                title="List User"
                :href="route('consumer.index',element.id)"
                
                class="inline-block px-4 py-1.5 bg-gray-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
              >
                <icon name="list" />
              </Link>
                </td>-->
                <td class="px-6 py-4">
                  <!-- :href="route('section.index',element.id)" -->
                  <Link
                    :href="route('section.index',element.id)"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Sections"
                    class="inline-block px-4 py-2.5 bg-gray-600 text-white font-medium text-2xl leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                  >
                    <icon name="secion" />
                  </Link>
                  <a
                    data-toggle="tooltip"
                    data-placement="top"
                      title="Edit"
                    @click="onEdit(element)"
                    class="inline-block px-4 py-2.5 bg-gray-600 text-white font-medium text-2xl leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                  >
                    <icon name="edit" />
                  </a>

                  <a
                    data-toggle="tooltip"
                    data-placement="top"
                      title="Delete"
                    @click="onDelete(element.id)"
                    class="inline-block px-4 py-2.5 bg-red-600 text-white font-medium text-2xl leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
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
import PageModal from "@/Components/Modal/PageModal";
import Layout from "@/Components/Layout/Layout";
import { Link } from "@inertiajs/inertia-vue";
import draggable from "vuedraggable";

export default {
  layout: Layout,
  components: {
    PageModal,
    Icon,
    Link,
    draggable,
    ContentHeaderVue,
    Alert
  },
  props: {
    pages: Array,
    errors: Object
  },
  data() {
    return {
      term: null,
      disabled: false,
      form: this.$inertia.form({
        id: null,
        name: null
        // start_date: null
      })
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
    onAddClass() {
      Bus.$emit("onAddPage");
    },

    onEdit(data) {
      Bus.$emit("onEditPage", data);
    },
    onDelete(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(this.route("pages.delete", id));
    },
    onUnpublishedChange() {
      let query = {
        data: this.pages
      };
      this.$inertia.post(this.route("pages.priority"), query, {
        preserveState: false
      });
    }
    // warnDisabled() {
    //   this.disabled = true
    //     setTimeout(() => {
    //       this.disabled = false
    //     }, 1500)
    //   }
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

.shake {
  animation: shake 0.82s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
  transform: translate3d(0, 0, 0);
}

@keyframes shake {
  10%,
  90% {
    transform: translate3d(-1px, 0, 0);
  }

  20%,
  80% {
    transform: translate3d(2px, 0, 0);
  }

  30%,
  50%,
  70% {
    transform: translate3d(-4px, 0, 0);
  }

  40%,
  60% {
    transform: translate3d(4px, 0, 0);
  }
}
</style>