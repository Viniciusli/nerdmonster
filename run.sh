docker compose -f "docker-compose.yml"  -p "nerdmonster" start
sudo chown -R www-data:www-data ./back
docker exec back php artisan queue:work