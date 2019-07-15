
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('oficina', require('./components/Oficina.vue'));
Vue.component('expediente', require('./components/Expediente.vue'));
Vue.component('persona', require('./components/Persona.vue'));
Vue.component('solicitante', require('./components/Solicitante.vue'));
Vue.component('regexpediente', require('./components/Regexpediente.vue'));
Vue.component('rol', require('./components/Rol.vue'));
Vue.component('user', require('./components/User.vue'));
Vue.component('consultaregistro', require('./components/ConsultaRegistro.vue'));

const app = new Vue({
    el: '#app',
    data :{
        menu : 0
    }
});
