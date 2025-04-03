printf "\n> Instalando o back-end\n"
cd ./backend
cp .env.example .env

printf "\n> Instalando o front-end\n"
cd ../frontend
yarn
cp .env.example .env

printf "\n> Rodando os containers\n"
docker-compose up -d --build

printf "\n> instalando composer\n"
docker exec mariah_api bash -c "composer install"

printf "\n> Rodando as migrations e seeders dentro do container\n"
docker exec mariah_api php artisan migrate:fresh --seed

printf "\n> Rodando o server local dentro do container\n"
docker exec -d mariah_api php artisan serve --host=0.0.0.0 --port=8000

sleep 5

if command -v xdg-open > /dev/null; then
    xdg-open http://localhost:3000
elif command -v gio > /dev/null; then
    gio open http://localhost:3000
elif command -v sensible-browser > /dev/null; then
    sensible-browser http://localhost:3000
elif command -v google-chrome > /dev/null; then
    google-chrome http://localhost:3000
elif command -v firefox > /dev/null; then
    firefox http://localhost:3000
else
    printf "\n> Não foi possível abrir o navegador automaticamente. Acesse: http://localhost:3000\n"
fi