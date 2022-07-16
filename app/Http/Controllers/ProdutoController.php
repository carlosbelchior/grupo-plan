<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use App\Models\Produto;

class ProdutoController extends Controller
{
    // Retorna todos os produtos
    public function todos()
    {
        return response()->json(['produto' => Produto::with(['marca'])->get(), 'type' => 'data'], 200);
    }

    // Cadastra novo produto
    public function cadastro(StoreProdutoRequest $request)
    {
        // Salva o Produto
        $produto = Produto::create($request->validated());
        if($produto)
            return response()->json(['message' => 'Produto cadastrado com sucesso', 'type' => 'success'], 200);

        // Erro geral
        return response()->json(['message' => 'Ocorreu um erro ao salvar o Produto, verifique sua conexão e tente novamente!', 'type' => 'error'], 400);
    }

    // Retorna um produto especifico
    public function encontrar($id)
    {
        // Busca o Produto
        if(Produto::find($id))
            return response()->json(['produto' => Produto::with('marca')->find($id), 'type' => 'data'], 200);

        // Erro geral
        return response()->json(['message' => 'Produto não encontrado.', 'type' => 'geral'], 400);
    }

    // Atualiza um produto especifico
    public function atualizar(UpdateProdutoRequest $request, $id)
    {
        $produto =  Produto::find($id);
        if(!$produto)
            return response()->json(['message' => 'Produto não encontrado.', 'type' => 'geral'], 400);

        // Atualiza o Produto
        if($produto->update(array_filter($request->validated())))
            return response()->json(['message' => 'Produto atualizado com sucesso.', 'type' => 'success'], 200);

        // Erro geral
        return response()->json(['message' => 'Ocorreu um erro ao editar o Produto, verifique sua conexão e tente novamente.', 'type' => 'geral'], 400);
    }

    // Deleta um produto especifico
    public function exclusao($id)
    {
        $produto = Produto::find($id);

        // Verifica se o Produto existe
        if(!$produto)
            return response()->json(['message' => 'Produto não encontrado.', 'type' => 'error'], 400);

        // Deleta o Produto
        if($produto->delete())
            return response()->json(['message' => 'Produto deletado com sucesso', 'type' => 'success'], 200);

        // Erro geral
        return response()->json(['message' => 'Ocorreu um erro ao editar o Produto, verifique sua conexão e tente novamente.', 'type' => 'geral'], 400);
    }
}
