import { createStore } from "vuex";

import produto from "./modules/produto";
import marca from "./modules/marca";

const store = createStore({
    modules: {
        marca,
        produto
    },
});

export default store;
