require('./bootstrap');

window.Vue = require('vue');

import * as VueGoogleMaps from "vue2-google-maps";

Vue.use(VueGoogleMaps, {
    load: {
        key: process.env.MIX_GOOGLE_API_TOKEN,
        libraries: "places"
    }
});

Vue.component('AddressComponent', require('./components/AddressComponent.vue').default);

const app = new Vue({
    el: '#app',
});
