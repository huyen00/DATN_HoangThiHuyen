<template>
  <div
    ref="contextMenuPemission"
    v-if="menuVisible"
    v-bind:style="menuStyle"
    v-on:blur="closeMenu"
    class="fm-context-menu"
    tabindex="-1"
  >
    <ul v-for="(group, index) in menu" v-bind:key="`g-${index}`" class="list-unstyled">
      <li
        v-for="(item, index) in group"
        v-bind:key="`i-${index}`"
        v-on:click="menuAction(item.name)"
        
      >
        <i class="fa-fw" v-bind:class="item.icon" />
        {{item.name }}
      </li>
    </ul>
  </div>
</template>

<script>
import translate from "../../mixins/translate";
export default {
  data() {
    return {
      context: null,
      menuVisible: false,
      menuStyle: {
        top: 0,
        left: 0
      },
      menu: [
        [
          {
            name: "edit",
            icon: "bi-pencil-square"
          }
        ],
        [
          {
            name: "delete",
            icon: "bi-trash text-danger"
          }
        ]
      ]
    };
  },
  mounted() {
    /**
     * Listen events
     * 'contextMenu'
     */
    Bus.$on("contextMenuPemission", (item, event) => {
      console.log(event);
      this.context = item;
      this.showMenu(event);
    });
  },
  computed: {},
  methods: {
    /**
     * Show context menu
     * @param event
     */
    showMenu(event) {
      if (this.context) {
        this.menuVisible = true;

        // focus on menu
        this.$nextTick(() => {
          this.$refs.contextMenuPemission.focus();
          // set menu params
          this.setMenu(event.pageY, event.pageX);
        });
      }
    },

    /**
     * Set context menu coordinates
     * @param top
     * @param left
     */
    setMenu(top, left) {
      // get parent el (.fm-body)
      const el = this.$refs.contextMenuPemission.parentNode;

      // get parent el size
      const elSize = el.getBoundingClientRect();

      // actual coordinates of the block
      const elY = window.pageYOffset + elSize.top;
      const elX = window.pageXOffset + elSize.left;

      // calculate the preliminary coordinates
      let menuY = top - elY;
      let menuX = left - elX;

      // calculate max X and Y coordinates
      const maxY =
        elY + (el.offsetHeight - this.$refs.contextMenuPemission.offsetHeight - 25);
      const maxX =
        elX + (el.offsetWidth - this.$refs.contextMenuPemission.offsetWidth - 25);

      if (top > maxY) menuY = maxY - elY;
      if (left > maxX) menuX = maxX - elX;

      // set coordinates
      this.menuStyle.top = `${menuY}px`;
      this.menuStyle.left = `${menuX}px`;
    },

    /**
     * Close context menu
     */
    closeMenu() {
      this.menuVisible = false;
    },
    menuAction(name) {
      console.log(this.context);
      Bus.$emit("menuAction", this.context, name);
      this.closeMenu();
    }
  }
};
</script>

<style lang="scss">
.fm-context-menu {
  position: absolute;
  z-index: 9997;
  background-color: white;
  box-shadow: 3px 2px 5px gray;
  border-radius: 5px;

  &:focus {
    outline: none;
  }

  .list-unstyled {
    margin-bottom: 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
  }

  ul > li {
    padding: 0.4rem 1rem;
  }

  ul > li:not(.disabled) {
    cursor: pointer;

    &:hover {
      background-color: #f8f9fa;
    }

    i {
      padding-right: 2rem;
    }
  }
}
</style>
