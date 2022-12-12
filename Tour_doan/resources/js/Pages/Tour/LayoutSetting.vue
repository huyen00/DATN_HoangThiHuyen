<template>
    <div :class="['wrapper', classes]">
      <Header></Header>
  
      <!-- Left side column. contains the logo and sidebar -->
      <SiderBar />
  
  
      <div class="content-wrapper screen_fullcontent">
        <Nabar :tour="tour"></Nabar>
        <ul class="flex flex-wrap border-b border-gray-200 dark:border-gray-700 mt-8">
            <li class="mr-2">
                <Link  :href="route('tour.setting.index', tour.id)" aria-current="page" :class=" $page.component === 'Tour/Setting/Index' ? 'inline-block bg-gray-50 text-blue-600 rounded-t-lg py-4 px-8 text-xl font-medium text-center active dark:bg-gray-800 dark:text-blue-500':'inline-block text-gray-500 hover:text-gray-600 hover:bg-gray-50 rounded-t-lg py-4 px-8 text-xl font-medium text-center dark:text-gray-400  dark:hover:bg-gray-800 dark:hover:text-gray-300'">Setting</Link>
            </li>
            <li class="mr-2">
                <Link   :href="route('tour.setting-display.index', tour.id)" :class=" $page.component === 'Tour/Setting/SettingDisplay' ? 'inline-block  bg-gray-50 text-blue-600 rounded-t-lg py-4 px-8 text-xl font-medium text-center active dark:bg-gray-800 dark:text-blue-500':'inline-block text-gray-500 hover:text-gray-600 hover:bg-gray-50 rounded-t-lg py-4 px-8 text-xl font-medium text-center dark:text-gray-400  dark:hover:bg-gray-800 dark:hover:text-gray-300'">Setting Display</Link>
            </li>
            <li class="mr-2">
                <Link    :href="route('tour.setting-color.index', tour.id)" :class=" $page.component === 'Tour/Setting/SettingColor' ? 'inline-block  bg-gray-50 text-blue-600 rounded-t-lg py-4 px-8 text-xl font-medium text-center active dark:bg-gray-800 dark:text-blue-500':'inline-block text-gray-500 hover:text-gray-600 hover:bg-gray-50 rounded-t-lg py-4 px-8 text-xl font-medium text-center dark:text-gray-400  dark:hover:bg-gray-800 dark:hover:text-gray-300'">Setting Color</Link>
            </li>
    

        </ul>
        <slot />
      </div>
      <dash-footer></dash-footer>
    </div>
  </template>
  
  <script>
  import DashFooter from "@/Components/Layout/DashFooter";
  import Header from "@/Components/Layout/Header";
  import Menu from "@/Components/Layout/Menu";
  import SiderBar from "@/Components/Layout/SiderBar";
  import UserMenu from "@/Components/Layout/UserMenu";
  import Nabar from "./Nabar.vue";
  import config from "../../config";
  import { Link } from "@inertiajs/inertia-vue";
  import "hideseek";
  export default {
    components: {
      DashFooter,
      Header,
      Menu,
      SiderBar,
      UserMenu,
      Nabar,
      Link
    },
    props: {
      tour: Object
    },
    data: function() {
      return {
        // section: 'Dash',
        classes: {
          fixed_layout: config.fixedLayout,
          hide_logo: config.hideLogoOnMobile
        }
      };
    }
  };
  </script>
  
  <style>
  .wrapper.fixed_layout .main-header {
    position: fixed;
    width: 100%;
  }
  .wrapper.fixed_layout .content-wrapper {
    padding-top: 50px;
  }
  .wrapper.fixed_layout .main-sidebar {
    position: fixed;
    height: 100vh;
  }
  
  @media (max-width: 767px) {
    .wrapper.hide_logo .main-header .logo {
      display: none;
    }
  }
  
  .logo-mini,
  .logo-lg {
    text-align: left;
  }
  .logo-mini img,
  .logo-lg img {
    padding: 0.4em !important;
  }
  
  .logo-lg img {
    display: -webkit-inline-box;
    width: 25%;
  }
  
  .user-panel {
    height: 4em;
  }
  
  hr.visible-xs-block {
    width: 100%;
    background-color: rgba(0, 0, 0, 0.17);
    height: 1px;
    border-color: transparent;
  }
  </style>
  