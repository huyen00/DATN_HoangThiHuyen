<template>
    <section class="content">
      <!-- <ContextMenu /> -->
      <ContentHeaderVue :name="'Page'" :icon="'fa fa-home'" />
      <BreadCrumb :crumbs="crumbs" />
  
      <button
        type="button"
        class="inline-block px-8 py-4 bg-blue-600 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
        data-toggle="modal"
        data-target="#exampleModal"
     
      >Create Page</button>
  
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
              <!-- <h5 class="modal-title" id="exampleModalLabel" v-if="editMode">Update Pages</h5>
              <h5 class="modal-title" id="exampleModalLabel" v-else>Create Pages</h5> -->
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form >
                <div class="form-group" :class="errors.name ? 'is-valid' :''">
                  <div class="list_form_page">
                    <div class="item_form_page w-4/12 pr-6 ">  
                      <label for="recipient-name" class="col-form-label">Title key:</label>
                      <input
                        type="text"
                        class="form-control text-xl"
                        :class="errors.name ? 'is-valid' :''"
                        v-model="form.name"
                        id="recipient-name"
                      />
                    </div>
                    <div class="item_form_page w-4/12 pl-6">
                      <label for="recipient-name" class="col-form-label">Title English:</label>
                      <input
                        type="text"
                        class="form-control text-xl"
                        :class="errors.name ? 'is-valid' :''"
                        v-model="form.name"
                        id="recipient-name"
                      />
                    </div>
                    <div class="item_form_page w-4/12 pl-6">
                      <label for="recipient-name" class="col-form-label">Title VietNam:</label>
                      <input
                        type="text"
                        class="form-control text-xl"
                        :class="errors.name ? 'is-valid' :''"
                        v-model="form.name"
                        id="recipient-name"
                      />
                    </div>
                  </div>
                  <div class="list_form_page">
                    <div class="item_form_page w-6/12 pr-6 ">  
                      <label for="recipient-name" class="col-form-label">Description_en:</label>
                      <input
                        type="text"
                        class="form-control text-xl"
                        :class="errors.name ? 'is-valid' :''"
                        v-model="form.name"
                        id="recipient-name"
                      />
                    </div>
                    <div class="item_form_page w-6/12 pl-6">
                      <label for="recipient-name" class="col-form-label">Description_vn:</label>
                      <input
                        type="text"
                        class="form-control text-xl"
                        :class="errors.name ? 'is-valid' :''"
                        v-model="form.name"
                        id="recipient-name"
                      />
                    </div>
                  </div>
                  <!-- <div class="text-red-500" v-if="errors.name">{{ errors.name }}</div> -->
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                    data-dismiss="modal"
                  >Close</button>
                  <button
               
                    type="submit"
                    class="inline-block px-6 py-2.5 bg-gray-800 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out"
                  >Save changes</button>
                </div>
              </form>
            </div>
  
            
          </div>
        </div>
      </div>
      <form action="" class="overflow-x-auto relative shadow-md sm:rounded-lg mt-5">
        <table class="w-full text-xl text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <td scope="col" class="py-3 px-6 text-xl">STT</td>
            <td scope="col" class="py-3 px-6 text-xl">Title</td>
            <td scope="col" class="py-3 px-6 text-xl">Description</td>
            <td class="sr-only">Action</td>
          </thead>
          <tbody>
            <td></td>
            <td></td>
            <td></td>
          </tbody>
        </table>
      </form>
     <!-- <div class="page_content">
       <el-table >
          <el-table-comlum label="STT"></el-table-comlum>
          <el-table-comlum label="Tite"></el-table-comlum>
          <el-table-comlum label="Description"></el-table-comlum>
          <el-table-comlum label="Action"></el-table-comlum>
       </el-table>
     </div> -->
      <!-- <pagination :links="permissions.links" /> -->
    </section>
  </template>
  
  <script>
  import { Link, Head } from "@inertiajs/inertia-vue";
  import Layout from "@/Components/Layout/Layout";
  import ContentHeaderVue from "@/Components/Layout/ContentHeader";
  import Pagination from "@/Components/Pagination";
  import BreadCrumb from "@/Pages/Tour/BreadCrumb";
  
  
  
  export default {
    layout: Layout,
    components: {
      Link,
      Head,
      ContentHeaderVue,
     
      BreadCrumb,
       
    },
    props:{
      errors:Object
     
    },
    data() {
      return {
       
        form: this.$inertia.form({
          id: null,
          name: null
        }),
        crumbs: [
          {
            route: "page.index",
            parma: null,
            name: "Page"
          }
        ]
      };
    },
    
    methods:{
      
    }
  };
  </script>
  <style>
  .list_form_page{
    display:flex;
  }
  
  </style>
  