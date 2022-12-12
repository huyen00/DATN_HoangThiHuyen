<template>
    <transition name="fm-modal">
        <div class="fm-modal" ref="fmModal" >
            <div class="modal-dialog"
                 role="document"
                 v-bind:class="modalSize"
                 v-on:click.stop>
                <component v-bind:is="modalName" :hotspot="hotspot" :errors="errors" :panos="panos"/>
            </div>
        </div>
    </transition>
</template>

<script>
import showText from '@/Pages/Tour/Hotspot/Modal/showText';
import ModalFrame from '@/Pages/Tour/Hotspot/Modal/ModalFrame';
import ModalImage from '@/Pages/Tour/Hotspot/Modal/ModalImage';
import ModalScene from '@/Pages/Tour/Hotspot/Modal/ModalScene';
import ModalLink from '@/Pages/Tour/Hotspot/Modal/ModalLink';
import ModalScript from '@/Pages/Tour/Hotspot/Modal/ModalScript';
export default {
  name: 'Modal',
  components: {
    showText,
    ModalFrame,
    ModalImage,
    ModalScene,
    ModalScript,
    ModalLink
  },
  props:{
    errors:Object,
    panos:Array
  },
  mounted() {
    // set height
    this.$store.commit('fm/tour/setModalBlockHeight', this.$refs.fmModal.offsetHeight);
  },
  computed: {
    /**
     * Selected modal name
     * @returns {null|*}
     */
    modalName() {
      return this.$store.state.fm.tour.modalName;
    },
    hotspot() {
      return this.$store.state.fm.tour.select_hotspot;
    },
    /**
     * Modal size style
     * @returns {{'modal-lg': boolean, 'modal-sm': boolean}}
     */
    modalSize() {
      return {
        'modal-xl': this.modalName === 'Preview' || this.modalName === 'TextEdit',
        'modal-lg': this.modalName === 'VideoPlayer',
        'modal-sm': false,
      };
    },
  },
  methods: {
    /**
     * Hide modal window
     */
    hideModal() {
      this.$store.commit('fm/tour/clearModal');
    },
  },
};
</script>

<style lang="scss">
    .fm-modal {
        position: fixed;
        z-index: 9998;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .35);
        display: block;
        transition: opacity .4s ease;
        overflow: auto;
        .modal-xl {
            max-width: 96%;
        }
    }
    .fm-modal-enter-active, .fm-modal-leave-active {
        transition: opacity .5s;
    }
    .fm-modal-enter, .fm-modal-leave-to {
        opacity: 0;
    }
    // .modal {
    // position: fixed;
    // }
</style>
