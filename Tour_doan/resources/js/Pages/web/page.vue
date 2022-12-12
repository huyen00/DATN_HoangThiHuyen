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
            <form action="" method="POST">
                <div class="">
                  <label for="">Title key</label>
                  <input type="text" class="form-control" name="">
                </div>
                <div class="">
                  <label for="">Title </label>
                  <input type="text" class="form-control" name="">
                </div>
                <div class="">
                  <label for="">Description</label>
                  <input type="text" class="form-control" name="">
                </div>
                <div class="text-right pt-6">
                  <button   class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" data-dismiss="modal">Cancel</button>
                <button  @click.prevent="save()"
                  type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                </div>
                
            </form>
          </div>
        </div>
      </div>
    </div>
    <form action="" class="overflow-x-auto relative shadow-md sm:rounded-lg mt-5">
      <table class="w-full text-xl text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <td scope="col" class="py-3 px-6 text-xl">STT</td>
            <td scope="col" class="py-3 px-6 text-xl">Title</td>
            <td scope="col" class="py-3 px-6 text-xl">Description</td>
            <td class="sr-only">Action</td>
          </tr>
        </thead>
        <tbody>
          @if (!empty($page))
            @foreach($page as $key => $item)
          <tr >
            <td class="py-3 px-6 text-xl">{{$key+1}}</td>
            <td class="py-3 px-6 text-xl"></td>
            <td class="py-3 px-6 text-xl"></td>
          </tr>
          @endforeach
          @else
          <tr>
            <td>Khoong co trang page nao</td>
          </tr>          
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
    errors:Object,
   pages:Array,
  },
  data() {
    return {
     
      form: this.$inertia.form({
        id: null,
        title: null,
        description:null,
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
   
  },
};
</script>
<style>
.list_form_page{
  display:flex;
}

</style>
