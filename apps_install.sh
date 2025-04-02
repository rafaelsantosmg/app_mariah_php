printf "\n> Instalando o back-end\n"
cd ./backend
composer install

printf "\n> Instalando o front-end\n"
cd ../frontend
yarn

printf "\n> Rodando os containers\n"
docker-compose up -d

printf "\n> Aguardando a inicialização dos containers\n"
sleep 5  # Dá um tempo para os containers subirem completamente

printf "\n> Rodando as migrations e seeders dentro do container\n"
docker exec -it mariah_api php artisan migrate:fresh --seed

printf "\n> Rodando o server local dentro do container\n"
docker exec -it mariah_api php artisan serve --host=0.0.0.0 --port=8000
