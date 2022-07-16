import store from "../store";

const init = () => {
    store.commit("produto/fetchProdutos");
    store.commit("marca/fetchMarcas");
};

export default init;
