window.Vue = require('vue')

/**
 * Loading e registering the plugins.
 */

require('./bootstrap')

let axios = require('axios')

import Lang from 'laravel-vue-lang'
Vue.use(Lang, {
    locale: 'pt-BR',
    fallback: 'en'
})

import Vuelidate from 'vuelidate/src'
Vue.use(Vuelidate)

import VueInputMask from "vue-inputmask"
Vue.use(VueInputMask.default)

import VueSweetalert2 from 'vue-sweetalert2'
Vue.use(VueSweetalert2)

/**
 * Defining Vue components.
 */

Vue.component('contact-form-component', require('./components/ContactFormComponent.vue').default)
Vue.component('loader-component', require('./components/LoaderComponent.vue').default)

/**
 * Attaching a new instance of the Vue application to the page.
 */
const app = new Vue({
    el: '#page'
})
