/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import mainComponent from "./components/mainComponent";

require('./bootstrap');

window.Vue = require('vue');
import "@mdi/font/css/materialdesignicons.css";

import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import Vue from 'vue'
import VueRouter from 'vue-router';
import VueApexCharts from 'vue-apexcharts'
import presidentialCandidateComponent from "./components/presidentialCandidateComponent";
import parliamentaryCandidateCompoenet from "./components/parliamentaryCandidateCompoenet";
Vue.use(VueApexCharts);

Vue.component('apexchart', VueApexCharts);


Vue.use(VueRouter);

Vue.use(Vuetify);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const routes = [
    {
        path:'/',
        component: mainComponent
    },
    {
        path:'/presidentialcandidate/:id',
        component: presidentialCandidateComponent
    },
    {
        path:'/parliamentarycandidate/:id',
        component: parliamentaryCandidateCompoenet
    }
];

const router = new VueRouter({
    routes,
    mode:'history'

});



const app = new Vue({
    el: "#app",
    router,
    vuetify: new Vuetify(),
    components:{},
    data(){
        return{

            num:0

        }
    },
    methods:{

    },
    mounted(){

    }
}).$mount('#app');

Vue.filter("short_number", (d) => {
    var output = 0;
    if (Number(d) < 1000) {
        output = Number(d).toFixed(1);
    } else if (Number(d) > 999) {
        output = (Number(d) / 1000).toFixed(1) + "K";
    } else if (Number(d) > 999999) {
        output = (Number(d) / 1000000).toFixed(1) + "M";
    } else {
        output = Number(d)
            .toFixed(2)
            .replace(/\d(?=(\d{3})+\.)/g, "$&,");
    }

    return output;
});

Vue.filter("toMoney", (d) => {
    if (d) {
        return d
            .replace(/\d(?=(\d{3})+\.)/g, "$&,");
    } else {
        return "0";
    }
});
