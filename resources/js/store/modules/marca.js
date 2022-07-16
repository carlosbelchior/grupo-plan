import axios from "axios";

const state = {
    loading: false,
    marcas: [],
};

const getters = {
    getMarcas: (state) => {
        return state.marcas
    }
}

const mutations = {
    async fetchMarcas(state) {
        axios.get("/api/marcas/todos")
            .then((response) => {
                state.marcas = response.data.marca;
            })
            .catch((err) => console.log(err));
    },
};

export default {
    namespaced: true,
    state,
    mutations,
    getters
};
