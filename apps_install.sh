printf "\n> Instalando o back-end\n"
cd ./backend
mv .env.example .env
composer install

printf "\n> Instalando o front-end\n"
cd ../frontend
mv .env.example .env
yarn

printf "\n> Rodando os containers\n"
docker-compose up -d --wait

printf "\n> Rodando as migrations e seeders dentro do container\n"
docker exec -it mariah_api php artisan migrate:fresh --seed

printf "\n> Rodando o server local dentro do container\n"
docker exec -it mariah_api php artisan serve --host=0.0.0.0 --port=8000

xdg-open http://localhost:3000