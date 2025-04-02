# Usando a imagem oficial do Node.js 18
FROM node:18 AS builder

# Definindo o diretório de trabalho no container
WORKDIR /app

# Copiando o package.json e o yarn.lock para instalar as dependências
COPY package.json yarn.lock ./

# Instalando as dependências (desenvolvimento)
RUN yarn install

# Copiando o código-fonte do frontend
COPY . .

# Expondo a porta 3000
EXPOSE 3000

# Comando para rodar a aplicação Next.js em modo de desenvolvimento
CMD ["yarn", "dev"]
