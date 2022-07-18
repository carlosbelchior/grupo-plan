# GRUPO PLAN - BELCHIOR
Software Grupo Plan - Por Carlos Belchior.

## Tecnologias
As tecnologias abaixo descritas foram utilizadas para desenvolver esse projeto.

- *Laravel 9.x*
- *Vue.js 3.x*  
- *Vuex 4.x*  
- *Vue router 4.x*  
- *MySQL*

## Configuração do projeto
Este é basicamente um projeto laravel. Para executar se faz necessário seguir os requisitos do framework. É EXTREMAMENTE recomendado que use docker para executar esta aplicação. Você pode instalr o Docker seguindo as instruções do link a seguir para [obter o docker](https://docs.docker.com/engine/install/).

As próximas sessões irão fornecer instruções de como configurar e executar a aplicação em um container Docker.

### Iniciando
Para configurar seu container docker execute o comando abaixo:

```bash
docker-compose up --build -d
```

Após criado o container docker acesse o serviço do PHP com o comando abaixo:
```bash
docker-compose exec php /bin/bash
```

O container docker será executado com imagens nginx, mysql e PHP.

#### Arquivos de configuração
Faça uma cópia do arquivo `.env.example`para `.env` e informe as variaveis de configuração conforme informado na documentação do Laravel no link a [seguir](https://laravel.com/docs/9.x/configuration).

Para testes locais use a seguinte configuração no .env:
```bash
APP_URL=http://localhost:8080
```

IMPORTANTE: As configurações de acesso padrões do banco de dados são:
- host: mysql
- database: default
- user: root
- password: admin

#### Instalando dependencias

Execute os comandos abaixo para instalar todas as dependencias do projeto:

Na imagem PHP do Docker execute o comando abaixo:

```bash
composer install 
```

Fora do docker execute o comando abaixo:

```bash
npm install 
```

#### Gerar chave laravel
Faça uma cópia do arquivo .env.example renomeando-o para .env, em seguida, acesse sua imagem PHP do docker e execute o comando abaixo:

```bash
php artisan key:generate 
```

#### Executando as migrations
Na imagem PHP do Docker e execute as migrations para configurar seu banco de dados:

```bash
php artisan migrate
```

#### Executando as seeds
Execute as seeds para criar os dados básicos:

```bash
php artisan db:seed
```

#### Executando testes
No seu serviço PHP e execute o comando abaixo para executar os testes do Laravel:

```bash
php artisan test
```

#### Rodando o sistema (testes locais)
Execute o comando abaixo direto no terminal do seu sistema, dentro da pasta do projeto

```bash
npm run dev
```

## Rotas da API

Para buscar os produtos:
```json
Method: GET
URL: /api/produtos/todos
```

Para inserir um produto:
```json
Method: POST
URL: /api/produtos/atualizar/ID_DO_PRODUTO
```
Data body:
- 'nome' => 'required|min:3'
- 'id_marca' => 'required|exists:marcas,id'
- 'tensao' => 'required|numeric|between:1,2'
- 'descricao' => 'required|min:3'

Para encontrar um produto:
```json
Method: GET
URL: /api/produtos/encontrar/ID_PRODUTO
```

Para atualizar um produto:
```json
Method: POST
URL: /api/produtos/atualizar/ID_DO_PRODUTO
```
Data body:
- 'nome' => 'required|min:3'
- 'id_marca' => 'required|exists:marcas,id'
- 'tensao' => 'required|numeric|between:1,2'
- 'descricao' => 'required|min:3'

Para excluir um produto:
```json
Method: GET
URL: /api/produtos/exclusao/ID_PRODUTO
```
