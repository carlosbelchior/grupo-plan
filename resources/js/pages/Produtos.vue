<template>
    <div class="container">

        <router-link class="btn btn-primary mb-3" to="/gerenciar/">+ Novo produto</router-link>

        <VTable class="table table-striped table-responsive table-bordered"
        :data="produtos"
        :filters="filters"
        :page-size="10"
        v-model:currentPage="currentPage"
        @totalPagesChanged="totalPages = $event"
        >
            <template #head>
                <tr>
                    <VTh class="col-1" sortKey="id">ID</VTh>
                    <VTh class="col-3" sortKey="nome">Nome</VTh>
                    <VTh class="col-2" sortKey="tensao">Tensão</VTh>
                    <VTh class="col-4" sortKey="email">Marca</VTh>
                    <th class="col-2">Ação</th>
                </tr>
            </template>
            <template #body="{rows}">
                <tr>
                    <td><input type="text" class="form-control form-control-sm" autocomplete="false" v-model="filters.id.value"/></td>
                    <td><input type="text" class="form-control form-control-sm" autocomplete="false" v-model="filters.nome.value"/></td>
                    <td><input type="text" class="form-control form-control-sm" autocomplete="false" v-model="filters.tensao.value"/></td>
                    <td><input type="text" class="form-control form-control-sm" autocomplete="false" v-model="filters.marca.value"/></td>
                    <td></td>
                </tr>
                <tr v-for="row in rows" :key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.nome }}</td>
                    <td>{{ row.tensao === 1 ? "110v" : "220v" }}</td>
                    <td>{{ row.marca.nome }}</td>
                    <td>
                        <router-link class="btn btn-primary btn-sm" :to="{ name: 'produto-formulario', params: { id: row.id }}">Editar</router-link>
                        <button class="btn btn-danger btn-sm mx-2" @click="excluirProduto(row.id)">Excluir</button>
                    </td>
                </tr>
            </template>
        </VTable>

        <VTPagination v-model:currentPage="currentPage" :total-pages="totalPages" :boundary-links="true"/>

    </div>
</template>

<script>
    import { computed } from "vue";
    import { useStore } from "vuex";
    import axios from "axios";
    import Swal from 'sweetalert2'
    export default {

        data: () => ({
            filters: {
                id: { value: '', keys: ['id'] },
                nome: { value: '', keys: ['nome'] },
                tensao: { value: '', keys: ['tensao'] },
                marca: { value: '', keys: ['marca.nome'] },
            },
            totalPages: 1,
            currentPage: 1
        }),

        setup() {
            const store = useStore();

            const produtos = computed(() => store.getters['produto/getProdutos'] );

            function excluirProduto(produto_id) {
                axios.get('/api/produtos/exclusao/' + produto_id).then(function (response) {
                    Swal.fire('Feito!', 'Produto excluido com sucesso!', 'success')
                    store.commit("produto/fetchProdutos");
                }).catch(function (error) {
                    Swal.fire('Opa!', 'Erro ao excluir o produto!', 'error')
                    store.commit("produto/fetchProdutos");
                });
            }

            return {
                produtos,
                excluirProduto
            };
        },
    };
</script>

<style lang="scss" scoped>
</style>
