<template>
    <div class="modal-content fm-modal-about">
        <div class="modal-header">
            <h5 class="modal-title"><strong>Image</strong></h5>
            <button type="button" class="close" aria-label="Close" v-on:click="hideModal">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <hr>
            <form @submit.prevent="save">
                <div class="form-group col-12" >
                <select name="action" v-model="form.action" @change="changeAction($event)"   :class="errors.action ? 'border-red-500' :''"
                 class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="onload">onload</option>
                    <option value="onloaded">onloaded</option>
                    <option value="onhover">onhover</option>
                    <option value="onclick">onclick</option>
                </select>
                <div class="text-red-500" v-if="errors.action">{{ errors.action }}</div>
              </div>
              <div class="form-group" :class="errors.thumb ? 'is-valid' :''">
                <label for="recipient-name" class="col-form-label">
                  Upload Image (jpg,png)
                </label>
                <div class="flex items-center justify-center w-full">
                  <label
                    class="flex flex-col w-full h-32 border-4 border-dashed hover:bg-gray-100 hover:border-gray-300"
                  >
                    <div class="flex flex-col items-center justify-center pt-7">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-12 h-12 text-gray-400 group-hover:text-gray-600"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                          clip-rule="evenodd"
                        />
                      </svg>
                      <p
                        class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600"
                      >Select a photo</p>
                    </div>
                    <input
                      type="file"
                      @input="form.image = $event.target.files[0]"
                      :class="errors.image ? 'border-red-500' :''"
                      class="opacity-0"
                      accept=".jpg, .png"
                    />
                  </label>
                  <div class="text-red-500" v-if="errors.image">{{ errors.image }}</div>
                </div>
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

export default {
  name: 'ModalImage',
  mixins: [modal, translate],
  props:{
    hotspot:Object,
    errors:Object,
  },
  data(){
    return {
        form:this.$inertia.form({
            action:"onclick",
            type:'popup_image',
            image : null
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
                var modalName="ModalImage";
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

                break;
            case "onclick":
            break;
         }
    }
  }
};
</script>
