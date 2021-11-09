/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Dashboard from "./components/Dashboard";

require('./bootstrap');
require('admin-lte');

window.Vue = require('vue').default;
import moment from "moment";
import VueProgressBar from 'vue-progressbar'

// ES6 Modules or TypeScript
import Swal from 'sweetalert2'
window.Swal = Swal

const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

window.toast = toast

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '2px'
})

import Form from 'vform'
import {HasError} from "vform/src/components/bootstrap5";
Vue.component(HasError.name, HasError)
window.Form = Form

import VueRouter from 'vue-router'
import Profile from "./components/Profile";
import Users from "./components/Users";

Vue.use(VueRouter)
const routes = [
    { path: '/dashboard', component: Dashboard },
    { path: '/profile', component: Profile },
    { path: '/users', component: Users },
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.filter('upText', function (text) {
    if (!text) return
    return text.charAt(0).toUpperCase() + text.slice(1)
})

Vue.filter('forHumans', function (date) {
    return moment(date).format('MMMM Do YYYY');
})

window.Fire = new Vue()

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    el: '#app',
    router
});
