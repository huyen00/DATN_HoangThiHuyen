<template>
  <ul class="sidebar-menu">
    <li class="header">TOOLS</li>
    <li tag="li" :class="[$page.component === 'Dashboard' ? 'active' : '']">
      <Link :href="route('dashboard')">
        <i class="fa fa-desktop"></i>
        <span class="page">Dashboard</span>
      </Link>
    </li>
    <!-- <li tag="li" class="pageli">
      <a>
        <i class="fa fa-table"></i>
        <span class="page">Tables</span>
      </a>
    </li>

    <li class="header">ME</li>
    <li tag="li" class="pageli">
      <a>
        <i class="fa fa-tasks"></i>
        <span class="page">Tasks</span>
      </a>
    </li>

    <li tag="li" class="pageli">
      <a>
        <i class="fa fa-cog"></i>
        <span class="page">Setting</span>
      </a>
    </li>-->
    <li tag="li" class="pageli" v-if="hasAnyPermission(['users-manager'])">
      <Link :href="route('fm.index')">
        <i class="fa fa-folder-o"></i>
        <span class="page">Files Managers</span>
      </Link>
    </li>

    <li
      tag="li"
      class="pageli"
      :class="[$page.component === 'Template/Index' ? 'active' : '']"
      v-if="hasAnyPermission(['users-manager'])"
    >
      <Link :href="route('template.index')">
        <i class="fa fa-puzzle-piece" aria-hidden="true"></i>
        <span class="page">Templates</span>
      </Link>
    </li>
    <!-- <li tag="li" class="pageli">
      <Link :href="route('manager-file.index')">
        <i class="fa fa-folder-o"></i>
        <span class="page">Files Manager 2</span>
      </Link>
    </li>-->
    <li class="treeview">
      <a href="#">
        <i class="fa fa-cube"></i>
        <span class="treeview-title">Tour Manager</span>
        <span class="pull-right-container pull-right">
          <i class="fa fa-angle-left fa-fw"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li :class="[$page.url.includes('/tours') ? 'active' : '']">
          <Link :href="route('tour.index')">
            <i :class="[$page.url.includes('/tours') ? 'fa fa-dot-circle-o' : 'fa fa-circle-thin']"></i>
            Tour
          </Link>
        </li>
        <!-- <li :class="[$page.component === 'Tour/Category/CategoryPano' ? 'active' : '']">
          <Link :href="route('category-pano.index')">
            <i
              :class="[$page.component === 'Tour/Category/CategoryPano'  ? 'fa fa-dot-circle-o' : 'fa fa-circle-thin']"
            ></i> Category Pano
          </Link>
        </li>-->
        <li :class="[$page.component === 'Tour/Category/CategoryHotspot' ? 'active' : '']">
          <Link :href="route('category-hotspot.index')">
            <i
              :class="[$page.component === 'Tour/Category/CategoryHotspot'  ? 'fa fa-dot-circle-o' : 'fa fa-circle-thin']"
            ></i> Category Hotspot
          </Link>
        </li>
      </ul>
    </li>

    <!-- <li class="treeview">
      <a href="#">
        <i class="fa fa-folder-o"></i>
        <span class="treeview-title">Files</span>
        <span class="pull-right-container pull-right">
          <i class="fa fa-angle-left fa-fw"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li>
          <a href="#">
            <i class="fa fa-file-word-o"></i> Item 1
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-file-picture-o"></i> Item 2
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-file-pdf-o"></i> Item 3
          </a>
        </li>
      </ul>
    </li>-->
    <li class="header" v-if="hasAnyPermission(['users-manager'])">web managerment</li>
    <li class="treeview" v-if="hasAnyPermission(['users-manager'])">
      <a href="#">
        <i class="fa fa-list"></i>
        <span class="treeview-title">web managerment</span>
        <span class="pull-right-container pull-right">
          <i class="fa fa-angle-left fa-fw"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li :class="[$page.component === 'Admin/Permission' ? 'active' : '']">
          <Link :href="route('pages')">
            <i class="fa fa-shield"></i> Pages
          </Link>
        </li>
        <li :class="[$page.component === 'Admin/Permission' ? 'active' : '']">
          <Link :href="route('tintuc.index')">
            <i class="fa fa-shield"></i> News
          </Link>
        </li>
        <li :class="[$page.component === 'Admin/Permission' ? 'active' : '']">
          <Link :href="route('themes.index')">
            <i class="fa fa-shield"></i> Themes
          </Link>
        </li>
      </ul>
    </li>
    <li class="header" v-if="hasAnyPermission(['users-manager'])">User managerment</li>
    <li class="treeview" v-if="hasAnyPermission(['users-manager'])">
      <a href="#">
        <i class="fa fa-list"></i>
        <span class="treeview-title">User managerment</span>
        <span class="pull-right-container pull-right">
          <i class="fa fa-angle-left fa-fw"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li :class="[$page.component === 'Admin/Permission' ? 'active' : '']">
          <Link :href="route('permissions.index')">
            <i class="fa fa-shield"></i> Permissions
          </Link>
        </li>
        <li :class="[$page.component === 'Admin/Roles' ? 'active' : '']">
          <Link :href="route('roles.index')">
            <i class="fa fa-check-circle"></i> Roles
          </Link>
        </li>
        <li :class="[$page.component === 'Admin/User' ? 'active' : '']">
          <Link :href="route('users.index')">
            <i class="fa fa-users"></i> Users
          </Link>
        </li>
      </ul>
    </li>
    <li class="header" v-if="hasAnyPermission(['users-manager'])">Language</li>
    <li tag="li" class="pageli" v-if="hasAnyPermission(['users-manager'])">
      <Link :href="route('language.index')">
        <i class="fa fa-language" aria-hidden="true"></i>
        <span class="page">Langauge</span>
      </Link>
    </li>

    <li class="header">Logout</li>
    <li tag="li" class="pageli">
      <Link :href="route('logout')" method="post">
        <i class="fa fa-sign-out text-yellow"></i>
        <span class="page">Logout</span>
      </Link>
    </li>
    <!-- <li tag="li" class="pageli">
      <a>
        <i class="fa fa-circle-o text-red"></i>
        <span class="page">404</span>
      </a>
    </li>-->
  </ul>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue";

import Language from "@/Components/LanguageSelector";
export default {
  components: {
    Link,
    Language
  }
};
</script>
<style>
/* override default */
.sidebar-menu > li > a {
  padding: 12px 15px 12px 15px;
}

.sidebar-menu li.active > a > .fa-angle-left,
.sidebar-menu li.active > a > .pull-right-container > .fa-angle-left {
  animation-name: rotate;
  animation-duration: 0.2s;
  animation-fill-mode: forwards;
}

.treeview-title {
  z-index: 1;
}

@keyframes rotate {
  0% {
    transform: rotate(0deg);
  }

  100% {
    transform: rotate(-90deg);
  }
}
.language_icon {
  display: flex;
}
</style>
