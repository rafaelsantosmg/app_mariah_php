# Projeto Mariah PHP
O sistema conta com um painel onde é possivel:
  * Cadastrar, listar e editar produtos.
  * Realizar vendas.
  * Realizar vendas fiado onde a mesma não cria relacionamento com outras tabelas apenas da baixa nos produtos.
  * Em breve estarei disponibilizando fechamento de caixa e consultas dos fechamento e relaório de vendas.


## Stack utilizada
**Front-end:** Next.js, Material UI.
**Back-end:** PHP, Laravel.

## BackEnd Laravel

### Descrição do projeto
O backend foi desenvolvido usando PHP com framework Laravel e banco de dados em PostgreSQL.

Ele conta com sistema de autenticação para gerar um token e dar acesso as rotas da API


### Desafios e Aprendizados
O desafio foi fazer o setup inicial, pois nunca tinha trabalhado com GraphQL. Então, optei por fazer um projeto simples com Node puro e Apollo Server. Fiz a API com a ajuda de um curso de GraphQL.

## FrontEnd NextJS
Frontend desenvolvido com Next.js e Material UI.

A aplicação disponibiliza um menu lareal onde vc consegue:
  * Criar vendas
  * Criar vendas fiada
  * Listar produtos
  * Recebimento de mercadorias
  * Abertura e fechamento de caixa ainda em produção

A aplicação possui um sistema de ordenação por colunas para facilitar o filtro e um sistema de paginação nas telas.

O sistema possui também uma tela para cadastro de produtos.

## Documentação das rotas:
  HOST: http://localhost:8000/api

  ### Rota de autenticação
  ```bash
  POST: /login
  body: {
      "email": "example@example.com",
      "password": "password"
    }
  ```

  ### Rotas de produtos
  ```bash
    GET: /products
    GET: /products/id
    DELETE: /products/id
  ```

  ```bash
  POST: /products
  body: {
      "code": "0001",
      "name": "Produto 1",
      "stockType": "UN",
      "stock": 20,
      "costPrice": 9.9,
      "salePrice": 20
    }
  ```

  ```bash
  PATCH: /products/id
  body: {
      "name": "Produto 2",
      "description": "Descrição do produto 2",
      "price": 20,
      "stock": 10 
    }
  ```

  ### Rotas de vendas
  ```bash
    GET: /sales
    GET: /sales/id
    DELETE: /sales/id
  ```

  ```bash
  POST: /sales
  body: {
      "discount": 0,
      "paymentMethod": "money",
      "products": [
        {
          "productId": 4,
          "productCode": "0499",
          "quantity": 1,
          "stockType": "UN"
        }
      ]
    }
  ```

# Rodando localmente
Clone o projeto:

```bash
git clone git@github.com:rafaelsantosmg/app_mariah_php.git
```

Entre no diretório do projeto:

```bash
cd app_mariah_php
```

Instalando as dependências e iniciando o projeto.
```bash
yarn
```

Esse script instala as dependências do backend e frontend e inicia os dois projetos em paralelo:

Toda a aplicação esta sendo utilizada com containers docker, certifique de não ter nenhuma autra imagem ou aplicação utilizando as portas necessárias para rodar o projeto.


### Após a inicialização do script, acesse [APP PRODUCTS](http://localhost:3000/).

```bash
Usuário: example@example.com
Senha: password
```

Obs: O backend roda na porta 8000 e o frontend na porta 3000.