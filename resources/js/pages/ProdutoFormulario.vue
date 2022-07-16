<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            {{ produto }}

            <div class="alert alert-danger alert-dismissible fade show" v-if="form.erro">
                Produto não encontrado!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>

            <div class="alert alert-danger alert-dismissible fade show" v-if="form.erroValidacao" v-for="erro in form.erroValidacao">
                {{ erro[0] }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <router-link class="btn btn-danger" to="/">Voltar</router-link>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Gerenciar produto
                </div>

                <div class="card-body">

                    <form method="POST" @submit.prevent="salvarProduto()">

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-md-end">Nome <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="nome" required autocomplete="false" autofocus v-model="form.nome">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-end">Tensão <span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <select class="form-select" name="tensao" required v-model="form.tensao">
                                            <option value="">Selecione a tensão</option>
                                            <option value="1">110v</option>
                                            <option value="2">220v</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-md-end">Marca <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="marca" required v-model="form.id_marca">
                                            <option value="">Selecione a marca</option>
                                            <option v-for="marca in marcas" :value="marca.id">{{ marca.nome }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label text-md-end">Descrição <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="nome" required autocomplete="false" autofocus v-model="form.descricao">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-success">
                                    Salvar produto
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</template>

<script>
    import { computed, reactive } from "vue";
    import { useRoute } from "vue-router";
    import { useStore } from "vuex";
    import axios from "axios";
    import Swal from 'sweetalert2'
    export default {
        setup() {
            //   posts are loaded from init function
            const store = useStore();
            const route = useRoute();

            const form = reactive({
                id: '',
                nome: '',
                descricao: '',
                tensao: '',
                id_marca: '',
                erro: false,
                erroValidacao: null
            })

            const marcas = computed(() => store.getters['marca/getMarcas'])

            const produto = computed(() => {
                form.erroValidacao = null;
                form.erro = false;

                if(route.params.id === ""){}
                else if(route.params.id != "" && store.getters['produto/getProduto'](parseInt(route.params.id)))
                {
                    form.id = store.getters['produto/getProduto'](parseInt(route.params.id)).id;
                    form.nome = store.getters['produto/getProduto'](parseInt(route.params.id)).nome;
                    form.descricao = store.getters['produto/getProduto'](parseInt(route.params.id)).descricao;
                    form.tensao = store.getters['produto/getProduto'](parseInt(route.params.id)).tensao;
                    form.id_marca = store.getters['produto/getProduto'](parseInt(route.params.id)).id_marca;
                }
                else
                    form.erro = true;
            })

            function salvarProduto() {

                let $this = this;
                form.erroValidacao = null;
                form.erro = false;

                if(!this.form.id)
                    axios.post('/api/produtos/cadastro', this.form).then(function (response) {
                        $this.form.id = '';
                        $this.form.nome = '';
                        $this.form.descricao = '';
                        $this.form.tensao = '';
                        $this.form.id_marca = '';
                        Swal.fire('Feito!', 'Produto cadastrado com sucesso!', 'success')
                        store.commit("produto/fetchProdutos");
                    }).catch(function (error) {
                        $this.form.erroValidacao = error.response.data.message
                    });
                else
                    axios.post('/api/produtos/atualizar/' + this.form.id, this.form).then(function (response) {
                        Swal.fire('Feito!', 'Produto atualizado com sucesso!', 'success')
                        store.commit("produto/fetchProdutos");
                    }).catch(function (error) {
                        $this.form.erroValidacao = error.response.data.message
                    });
			}

            return {
                store,
                form,
                produto,
                route,
                marcas,
                salvarProduto,
            };
        },
    };
</script>

<style lang="scss" scoped>
</style>
