<template>
  <div class="page-not-found">
    <div class="wrapper not-found">
      <h1 class="animated fadeIn">{{title}}</h1>
      <div class="desc animated fadeIn">
        <span>OOPS!</span>
        <br />
        {{ description }}
      </div>
      <Link :href="route('dashboard')" class="btn btn-primary btn-back-home mt-4 animated fadeInUp">
        <span class="btn-label mr-2">
          <i class="flaticon-home"></i>
        </span>
        Back To Home
      </Link>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue";
export default {
  components: {
    Link
  },
  props: {
    status: Number
  },
  computed: {
    title() {
      return {
        503: "503",
        500: "500",
        404: "404",
        403: "403",
        429: "429"
      }[this.status];
    },
    description() {
      return {
        503: "Sorry, we are doing some maintenance. Please check back soon.",
        500: "Whoops, something went wrong on our servers.",
        404: "Sorry, the page you are looking for could not be found.",
        403: "Sorry, you are forbidden from accessing this page.",
        429: "Too many request in serve"
      }[this.status];
    }
  }
};
</script>