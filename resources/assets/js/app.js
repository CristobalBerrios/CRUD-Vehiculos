window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found');
}

window.Vue = require('vue');
window.Vue.use(require('vuetify'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('usuarios-component', require('./components/usuarios/UsuariosComponent.vue'));
Vue.component('vehiculos-component', require('./components/vehiculos/VehiculosComponent.vue'));

const app = new Vue({
    el: '#app',
    data: {
        drawer: true
    },
    mounted () {
        document.querySelector("#app").style.visibility = 'visible'
    },
    methods: {
        go(ruta) {
            window.location = ruta
        }
    }
});
