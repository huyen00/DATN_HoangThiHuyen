<template>
  <section class="content">
    <Head title="Language" />
    <ContentHeaderVue :name="'Language'" />
    <alert :dismissible="true"></alert>

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
            <h5 class="modal-title" id="exampleModalLabel" v-if="editMode">Update Language</h5>
            <h5 class="modal-title" id="exampleModalLabel" v-else>Create Language</h5>

          
          </div>
          <div class="modal-body">
            <form @submit.prevent="save">
              <div
                class="w-1/4 bg-gray-200 rounded-full dark:bg-gray-700 mb-8 ml-3"
                v-if="form.progress"
              >
                <div
                  class="bg-blue-600 text-xl font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                  :style="{ width: form.progress.percentage + '%' }"
                >{{ form.progress.percentage }}%</div>
              </div>
             
                <div class="form-group" :class="errors.language ? 'is-valid' :''">
                <label class="col-form-label">Language:</label>
                <input
                  type="text"
                  class="form-control text-xl"
                  :class="errors.language ? 'border-red-500' :''"
                  v-model="form.language"
                  id="nameTour"
                />
                <div class="text-red-500" v-if="errors.language">{{ errors.language }}</div>
              </div>
       
              <div class="modal-footer">
                <button
                  type="button"
                  class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                  data-dismiss="modal"
                  :disabled="form.processing"
                >Close</button>
                <button
                  @click.prevent="save()"
                  type="submit"
                  class="inline-block px-6 py-2.5 bg-gray-800 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out"
                >Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row center-block">
      <h2>Data tables</h2>
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Language Table</h3>
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <div class="dataTables_wrapper form-inline dt-bootstrap" id="example1_wrapper">
              <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav flex felx-wrap">
                    <Language />
                  </ul>
                </div>
              </nav>
              <div class="row">
                <div class="col-sm-6">
                  <div id="example1_length" class="dataTables_length"></div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12 table-responsive">
                  <table
                    aria-describedby="example1_info"
                    role="grid"
                    id="example1"
                    class="table table-bordered table-striped dataTable"
                  >
                    <thead>
                      <tr role="row">
                        <th
                          aria-label="Rendering engine: activate to sort column descending"
                          aria-sort="ascending"
                          style="width: 204px;"
                          colspan="1"
                          rowspan="1"
                          aria-controls="example1"
                          tabindex="0"
                        >STT</th>
                        <th
                          aria-label="Rendering engine: activate to sort column descending"
                          aria-sort="ascending"
                          style="width: 204px;"
                          colspan="1"
                          rowspan="1"
                          aria-controls="example1"
                          tabindex="0"
                        >Key</th>
                        <th
                          aria-label="Rendering engine: activate to sort column descending"
                          aria-sort="ascending"
                          style="width: 204px;"
                          colspan="1"
                          rowspan="1"
                          aria-controls="example1"
                          tabindex="0"
                        >{{current_language}}</th>
                        <th
                          aria-label="Rendering engine: activate to sort column descending"
                          aria-sort="ascending"
                          style="width: 204px;"
                          colspan="1"
                          rowspan="1"
                          aria-controls="example1"
                          tabindex="0"
                        >Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr
                        v-for="(language,key,index) in languages"
                        :key="index"
                        class="even"
                        role="row"
                      >
                        <td>{{index}}</td>
                        <td>{{key}}</td>
                        <td>{{language}}</td>
                        <td>
                          <div class="flex mt-4 space-x-3 md:mt-6">
                            <button
                              data-toggle="modal"
                              data-target="#exampleModal"
                              @click="edit(language,key)"
                              class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xl leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                            >
                              <icon name="edit" />
                            </button>
                          
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>

import $ from "jquery";
// Require needed datatables modules
require("datatables.net");
require("datatables.net-bs");
import { Link, Head } from "@inertiajs/inertia-vue";
import ContentHeaderVue from "@/Components/Layout/ContentHeader";
import Pagination from "@/Components/Pagination";
import Alert from "@/Components/Alert";
import Layout from "@/Components/Layout/Layout";
import BreadCrumb from "@/Pages/Tour/BreadCrumb";
import Language from "@/Components/LanguageSelector";
import Icon from "@/Components/Icon";
export default {
  layout: Layout,
  components: {
    Link,
    ContentHeaderVue,
    Pagination,
    Alert,
    BreadCrumb,
    Head,
    Language,
    Icon
  },
  data(){
    return{
      editMode: false,
       form:this.$inertia.form({
          language:null,
          key:null,
          locale:this.$page.props.locale
       })
    }
  },  
  mounted() {
    this.$nextTick(() => {
      $("#example1").DataTable();
    });
  },
  props: {
    current_language: String,
    languages: Object | Array,
    errors:Object
  },
  methods:{
     edit(language,key){
        this.editMode=true;
        this.form.language =language;
        this.form.key = key;
        $('#exampleModal').on('shown.bs.modal', function () {
          $('#nameTour').focus();
        })
     },
     save() {
      if (this.editMode) {
        this.form.post(route("language.update", this.form.id), {
          preserveState: true,
          onError: errors => {
            if (Object.keys(errors).length > 0) {
              this.editMode = true;
            }
          },
          onSuccess: page => {
            this.$nextTick(() => {
                $("#exampleModal").hide();
                $('.modal-backdrop').fadeOut();
              this.reset();
            });
          
          }
        });
      } else {
        this.form.post(route("language.store"), {
          preserveState: true,
          onError: errors => {
            if (Object.keys(errors).length > 0) {
              this.editMode = false;
            }
          },
          onSuccess: page => {
            $("#exampleModal").hide();
                $('.modal-backdrop').fadeOut();
            this.reset();
          }
        });
      }
    },
    reset: function() {
      this.form = this.$inertia.form({
        language: null,
        key: null,
        locale:this.$page.props.locale
      });
    },

    clickModal() {
      this.editMode = false;
        $('#exampleModal').on('shown.bs.modal', function () {
        $('#nameTour').focus()
    });
      this.reset();
    },
  }
};
</script>

<style>
@import url("/static/js/plugins/datatables/dataTables.bootstrap.css");

table.dataTable thead .sorting:after,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_desc:after {
  font-family: "FontAwesome";
}

table.dataTable thead .sorting:after {
  content: "\f0dc";
}

table.dataTable thead .sorting_asc:after {
  content: "\f0dd";
}

table.dataTable thead .sorting_desc:after {
  content: "\f0de";
}
</style>