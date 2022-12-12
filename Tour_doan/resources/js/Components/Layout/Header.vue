<template>
  <header class="main-header">
    <span class="logo-mini">
      <a href="/">
       <!-- <img src="assets/img/logodh.png" class="w-full" alt=""> -->
      </a>
    </span>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="javascript:;" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav flex felx-wrap">
          <Language />
          <!-- <notifications-menu></notifications-menu> -->
          <UserMenu></UserMenu>
         
        </ul>
      </div>
    </nav>
  </header>
</template>

<script>
import UserMenu from "@/Components/Layout/UserMenu";
import NotificationsMenu from '@/Components/Layout/NotificationsMenu'
import Language from "@/Components/LanguageSelector"
export default {
  components: {
    UserMenu,
    NotificationsMenu,
    Language
  }
};
</script>
