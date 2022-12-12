<template>
  <div
    class="text-2xl font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-2xl font-medium text-center text-gray-500 dark:text-gray-400 nav-top">
      <li class="mr-2">
        <Link :href="route('tour.pano.index', tour.id)"
          :class="$page.url.includes('/panos')  ? 'inline-flex p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500 group' :'inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group'">
        <icon name="image"
          :class="$page.url.includes('/panos')  ? 'mr-2 w-6 h-6 text-blue-600 dark:text-blue-500':'mr-2 w-6 h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300'" />
        Panos
        </Link>
      </li>
      <li class="mr-2">
        <Link :href="route('tour.setting.index', tour.id)"
          :class=" $page.component.includes('Tour/Setting') ? 'inline-flex p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500 group' :'inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group'">
        <icon name="setting"
          :class=" $page.component.includes('Tour/Setting') ? 'mr-2 w-6 h-6 text-blue-600 dark:text-blue-500':'mr-2 w-6 h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300'">
        </icon>Setting
        </Link>
      </li>

      <li class="mr-2">
        <Link :href="route('tour.template.index', tour.id)"
          :class=" $page.component === 'Tour/Template/Index' ? 'inline-flex p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500 group' :'inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group'">
        <icon name="theme"
          :class="$page.component === 'Tour/Template/Index' ? 'mr-2 w-6 h-6 text-blue-600 dark:text-blue-500':'mr-2 w-6 h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300'">
        </icon>Template
        </Link>
      </li>
      
      <li class="mr-2">
        <Link :href="route('tour.sound.index', tour.id)"
          :class=" $page.component === 'Tour/Sound/Index' ? 'inline-flex p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500 group' :'inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group'">
        <icon name="sound"
          :class="$page.component === 'Tour/Sound/Index' ? 'mr-2 w-6 h-6 text-blue-600 dark:text-blue-500':'mr-2 w-6 h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300'">
        </icon>Sound
        </Link>
      </li>
      <li class="mr-2">
        <Link :href="route('tour.infor.index', tour.id)"
          :class=" $page.component === 'Tour/Infor/Index' ? 'inline-flex p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500 group' :'inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group'">
        <icon name="setting"
          :class="$page.component === 'Tour/Infor/Index' ? 'mr-2 w-6 h-6 text-blue-600 dark:text-blue-500':'mr-2 w-6 h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300'">
        </icon>Infor
        </Link>
      </li>
      
      
      <li class="mr-2">
        <Link :href="route('tour.font.index', tour.id)"
          :class=" $page.component === 'Tour/Font/Index' ? 'inline-flex p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500 group' :'inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group'">
        <i class="fa fa-font" name="setting"
          :class="$page.component === 'Tour/Font/Index' ? 'mr-2 w-6 h-6 text-blue-600 dark:text-blue-500':'mr-2 w-6 h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300'"></i>Font
        </Link>
      </li>
      <li class="mr-2">
        <Link :href="route('tour.category-pano.index', tour.id)"
          :class=" $page.component === 'Tour/Category/CategoryPano' ? 'inline-flex p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500 group' :'inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group'">
        <icon name="setting"
          :class="$page.component === 'Tour/Category/CategoryPano' ? 'mr-2 w-6 h-6 text-blue-600 dark:text-blue-500':'mr-2 w-6 h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300'">
        </icon>Category Pano
        </Link>
      </li>
      <li class="mr-2">
        <Link :href="route('tour.icon.index', tour.id)"
          :class=" $page.component === 'Tour/Icon/Index' ? 'inline-flex p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500 group' :'inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group'">
        <icon name="flag"
          :class="$page.component === 'Tour/Icon/Index' ? 'mr-2 w-6 h-6 text-blue-600 dark:text-blue-500':'mr-2 w-6 h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300'">
        </icon>Icon
        </Link>
      </li>
      <li class="mr-2">
        <Link :href="route('tour.map.index', tour.id)"
          :class=" $page.component === 'Tour/Map/Index' ? 'inline-flex p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500 group' :'inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group'">
        <icon name="map"
          :class="$page.component === 'Tour/Map/Index' ? 'mr-2 w-6 h-6 text-blue-600 dark:text-blue-500':'mr-2 w-6 h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300'">
        </icon>Map
        </Link>
      </li>
      <li class="mr-2">
        <a :href="route('tour.preview', tour.code)" target="_blank"
          class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
          <icon name="preview"
            class="mr-2 w-6 h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300">
          </icon>Preview
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue";
import Icon from "@/Components/Icon";
export default {
  components: {
    Link,
    Icon
  },
  props: {
    tour: Object
  }
};
</script>

<style>
.nav-top {
  /* padding-top: 50px; */
}
</style>
