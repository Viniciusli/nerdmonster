docker compose -f "docker-compose.yml"  -p "nerdmonster" start
docker exec back php artisan queue:work