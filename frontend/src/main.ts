import {createApp} from "vue";
import App from "./App.vue";
import router from "./dict/router/router.js";
import {VueQueryPlugin} from "vue-query";
import "../bootstrap.js";
import "./dict/vuetify/vuetify"
import "./dict/axios/api"
import vuetify from "./dict/vuetify/vuetify.js";
import {createPinia} from "pinia";


const pinia = createPinia()
const app = createApp(App)

app
    .use(router)
    .use(pinia)
    .use(vuetify)
    .use(VueQueryPlugin)
    .mount('#app')