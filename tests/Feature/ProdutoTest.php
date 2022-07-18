<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProdutoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_ok_marcas()
    {
        $response = $this->get('/api/marcas/todos');
        $response->assertStatus(200);
    }

    public function test_ok_lista_produtos()
    {
        $response = $this->get('/api/produtos/todos');
        $response->assertStatus(200);
    }

    // Report resources by planet - error
    public function test_ok_inserir_produto()
    {
        $response = $this->post('/api/produtos/cadastro', [
            'nome' => 'Geladeira',
            'id_marca' => 1,
            'tensao' => 2,
            'descricao' => 'Geladeira Aço Inox',
        ]);
        $response->assertStatus(200);
    }

    public function test_ok_encontrar_produto()
    {
        $response = $this->get('/api/produtos/encontrar/1');
        $response->assertStatus(200);
    }

    public function test_ok_atualizar_produto()
    {
        $response = $this->post('/api/produtos/atualizar/1', [
            'nome' => 'Gelagua',
            'id_marca' => 2,
            'tensao' => 2,
            'descricao' => 'Gelagua Aço Inox',
        ]);
        $response->assertStatus(200);
    }

    public function test_ok_deletar_produto()
    {
        $response = $this->get('/api/produtos/exclusao/1');
        $response->assertStatus(200);
    }

    public function test_error_400_inserir_produto()
    {
        $response = $this->post('/api/produtos/atualizar/1', [
            'nome' => 'Gelagua',
            'tensao' => 2,
            'descricao' => 'Gelagua Aço Inox',
        ]);
        $response->assertStatus(400);
    }

    public function test_error_400_encontrar_produto()
    {
        $response = $this->get('/api/produtos/encontrar/10000');
        $response->assertStatus(400);
    }

    public function test_error_400_atualizar_produto()
    {
        $response = $this->post('/api/produtos/atualizar/1', [
            'nome' => 'Gelagua',
            'tensao' => 2,
            'descricao' => 'Gelagua Aço Inox',
        ]);
        $response->assertStatus(400);
    }

    public function test_error_400_deletar_produto()
    {
        $response = $this->post('/api/produtos/atualizar/1', [
            'nome' => 'Gelagua',
            'tensao' => 2,
            'descricao' => 'Gelagua Aço Inox',
        ]);
        $response->assertStatus(400);
    }
}
