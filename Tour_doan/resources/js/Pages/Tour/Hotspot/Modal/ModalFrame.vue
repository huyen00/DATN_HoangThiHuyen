<template>
    <div class="modal-content fm-modal-about">
        <div class="modal-header">
            <h5 class="modal-title">Popup Web Frame</h5>
            <button type="button" class="close" aria-label="Close" v-on:click="hideModal">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form @submit.prevent="save">
                <div class="form-group col-12" >
                <select name="action" v-model="form.action" @change="changeAction($event)"   :class="errors.action ? 'border-red-500' :''"
                 class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <!-- <option value="onload">onload</option>
                    <option value="onloaded">onloaded</option> -->
                    <option value="onhover">onhover</option>
                    <option value="onclick">onclick</option>
                </select>
                <div class="text-red-500" v-if="errors.action">{{ errors.action }}</div>
              </div>
                <div class="form-group bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" :class="errors.description_en ? 'is-valid' :''">
                <label for="recipient-name" class="col-form-label">Link Url:</label>
                <input
                  type="text"
                  class="form-control text-xl"
                  :class="errors.description_en ? 'border-red-500' :''"
                  v-model="form.description_en"
                  id="recipient-name"
                />
                <div class="text-red-500" v-if="errors.description_en">{{ errors.description_en }}</div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                  data-dismiss="modal"
                  @click="hideModal()"
                >Close</button>
                <button
                  @click.prevent="save()"
                  type="submit"
                  class="inline-block px-6 py-2.5 bg-gray-800 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out"
                >Save changes </button>
              </div>
            </form>

        </div>
    </div>
</template>

<script>
    import modal from '../mixins/modal';
    import translate from '../../../../mixins/translate';
import Input from '../../../../Components/Input.vue';


    export default {
  components: { Input },
      name: 'showText',
      props:{
        hotspot:Object,
        errors:Object
      },
      data(){
        return {
            form:this.$inertia.form({
                action:"onhover",
                description_en:this.hotspot.onhover,
                type:'show_text'
        })
        }
      },
      mixins: [modal, translate],
      computed: {
        /**
         * App version
         * @returns {*}
         */
        version() {
          return this.$store.state.fm.settings.version;
        },

      },
      methods: {
        save() {
            this.form.post(route("tour.hotspot.action.update", this.hotspot.id), {
              preserveState: true,
              onError: errors => {
                if (Object.keys(errors).length > 0) {
                    var modalName="showText";
                    this.$store.commit("fm/tour/setModalState", {
                        modalName,
                        show: true
                    });
                }
              },
              onSuccess: page => {
                this.hideModal();
                this.reset();
              }
            });
        },
        changeAction(event){
            console.log(event.target.value)
            switch(event.target.value){
                case "onhover":
                    this.form.description_en= this.hotspot.onhover;
                    break;
                case "onclick":
                    this.form.description_en= this.hotspot.onclick;
                break;
             }
        }
      }
    };
    </script>
