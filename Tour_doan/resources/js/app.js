import './bootstrap';
// import jQuery from 'jQuery'

import Vue from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'
import VueCompositionAPI from '@vue/composition-api'
import CKEditor from 'ckeditor4-vue';
import fm from './store';
import VueLazyload from 'vue-lazyload'
import VueToast from 'vue-toast-notification';
import Vuex from 'vuex';
import { ColorPicker, ColorPanel } from 'one-colorpicker'

import $ from "jquery";
InertiaProgress.init({})
Vue.use(Vuex);
const errorimage = './assets/lazyloading/errors.gif'
const loadimage = './assets/lazyloading/loading.gif'
Vue.use(VueLazyload, {
    preLoad: 1.3,
    error: errorimage,
    loading: loadimage,
    attempt: 1
})
const store = new Vuex.Store({
    modules: { fm },
});
createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    title: title => `${title} - DoAn`,
    setup({ el, App, props, plugin }) {
        Vue.use(plugin)

        new Vue({
            store,
            render: h => h(App, props),
        }).$mount(el)
    },
})
Vue.mixin({
    methods: {
        route: window.route,
    }
})
Vue.mixin({
        methods: {
            hasAnyPermission: function(permissions) {

                var allPermissions = this.$page.props.auth.can;
                var hasPermission = false;
                permissions.forEach(function(item) {
                    if (allPermissions[item]) hasPermission = true;
                });
                return hasPermission;
            },
            hasAnyRoles: function(roles) {

                var allroles = this.$page.props.auth.roles;

                var hasRole = false;
                roles.forEach(function(item) {

                    if (allroles[item]) hasRole = true;

                });
                return hasRole;
            },
            hasRoles: function(user, roles) {
                var hasRole = false;
                user.roles.forEach(function(item) {
                    if (item.name == roles) hasRole = true;
                });
                return hasRole;
            },

            formatDate: function(value) {
                if (value) {
                    return moment(String(value)).format('DD/MM/YYYY HH:mm')
                }
            },
        },
    })
    // ????ng k?? m???t directive t??y bi???n c???p to??n c???c v???i t??n l?? `v-focus`

Vue.use(VueCompositionAPI)
    // ????ng k?? m???t directive t??y bi???n c???p to??n c???c v???i t??n l?? `v-focus`
Vue.directive('focus', {
    // Khi ph???n t??? li??n quan ???????c th??m v??o DOM...
    inserted: function(el) {
        // Ta g??n focus v??o ph???n t??? ????
        el.focus()
    }
})
Vue.mixin(require('./base'))
const el = document.getElementById('app')
Vue.mixin(require('./mixins/helper'))
Vue.mixin({
        methods: {
            route: window.route,
        }
    })
    // import 'vue-toast-notification/dist/theme-sugar.css';
Vue.use(VueToast);
window.Bus = new Vue();
Vue.config.devtools = true;
Vue.config.productionTip = true
Vue.use(CKEditor)
Vue.use(ColorPanel)
Vue.use(ColorPicker)
    // window.jQuery = jQuerx/