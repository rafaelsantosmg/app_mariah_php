# Projeto Mariah PHP
O objetivo é disponibilizar um front-end onde seja possível listar e fazer filtragem de produtos.

## Stack utilizada
**Front-end:** Next.js, Material UI.
**Back-end:** PHP, Laravel.

## BackEnd PHP
### Descrição do projeto
O backend foi desenvolvido usando Node.js, GraphQL, Apollo Server, e o banco de dados está sendo simulado com um arquivo de produtos no formato JSON.

Ele possui um Resolver que faz as requisições GET, onde a função products utiliza o módulo FS do Node.js para fazer a leitura do arquivo JSON e enviar os dados como retorno.

Para a parte do CREATE, foi desenvolvido o createProduct, onde a mesma faz uma validação verificando se o ID ou nome do produto já não existe no banco de dados. Se por ventura o produto já existir, ele retorna uma mensagem de erro, senão ele cria o novo produto.

Para os testes, utilizei o Jest.

### Desafios e Aprendizados
O desafio foi fazer o setup inicial, pois nunca tinha trabalhado com GraphQL. Então, optei por fazer um projeto simples com Node puro e Apollo Server. Fiz a API com a ajuda de um curso de GraphQL.

## FrontEnd RADIX
Frontend desenvolvido com Next.js, Apollo Client e Material UI.

### Descrição do projeto
O projeto consiste em exibir uma lista de produtos que vem através de uma API GraphQL e renderizá-los na tela em uma tabela com as seguintes informações:

* Nome
* Descrição
* Categoria
* Preço

A aplicação possui um sistema de ordenação por colunas.

O sistema possui também uma tela para cadastro de produtos com um formulário onde você faz o cadastramento de novos produtos.

### Desafios e Aprendizados
O desafio do projeto foi preparar um setup em Next.js, onde eu não estava familiarizado com o Framework e tive dificuldade em fazer toda configuração do setup.

Aprendi a evoluir minhas capacidades técnicas e tive a oportunidade de colocar em prática a escrita de códigos em TypeScript. Também pude aprender de uma maneira genérica como conectar meu frontend ao backend usando as tecnologias do Apollo Client e GraphQL.

Na tela de formulário, fiz todas as validações sem utilizar bibliotecas para demonstrar um pouco do meu pensamento lógico de como resolver problemas.

Na parte visual, dei ênfase em utilizar Material UI e seus componentes para a construção dos layouts e componentes.

# Rodando localmente
Clone o projeto:

```bash
git clone git@github.com:rafaelsantosmg/project-radix-app-products.git
```

Entre no diretório do projeto:

```bash
cd project-radix-app-products
```

Instalando as dependências e iniciando o projeto.
Esse script instala as dependências do backend e frontend e inicia os dois projetos em paralelo:

```bash
yarn run install:apps
```

### Após a inicialização do script, acesse [APP PRODUCTS](http://localhost:3000/).

Obs: O backend roda na porta 4000 e o frontend na porta 3000.

Se precisar iniciar o projeto novamente, utilize o comando abaixo na raiz do projeto:

```bash
yarn start
```

# Rodando Testes do backend:

```bash
cd app/backend
yarn test
```

# Rodando Testes do frontend:

```bash
cd app/frontend
yarn test
```