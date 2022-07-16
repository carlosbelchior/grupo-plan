import { createApp } from "vue";

// Root App
import App from "./components/App.vue";
import init from "./helpers/init.js";
import SmartTable from 'vuejs-smart-table';

// Vue Router
import router from "./router";

// Vuex Store
import store from "./store";

init();

const app = createApp(App);

// Mountin an app
app.use(SmartTable).use(store).use(router).mount("#app");
