docker compose up -d
docker exec back composer install
docker exec back composer run-script post-root-package-install
docker exec back php artisan key:generate
docker exec back php artisan migrate
docker exec back php artisan db:seed
docker compose -f "docker-compose.yml"  -p "loteria" stop
echo "Arquivo startup.sh sera removido!"
# rm install.sh 