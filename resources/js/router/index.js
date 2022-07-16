import { createRouter, createWebHistory } from "vue-router";

// Views
import Produtos from "../pages/Produtos.vue";
import ProdutoFormulario from "../pages/ProdutoFormulario.vue";

// WebHistory
const history = createWebHistory();

const routes = [
    {
        path: "/",
        component: Produtos,
        name: "produtos",
        meta: {
            title: "Produtos",
        },
    },
    {
        path: "/gerenciar/:id?",
        component: ProdutoFormulario,
        name: "produto-formulario",
        meta: {
            title: "Gerenciar Produto",
        },
    }
];

const router = createRouter({
    history,
    routes,
});

export default router;
