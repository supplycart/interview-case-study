setup:
	@make build
	@make up 
build:
	docker-compose build --no-cache --force-rm
stop:
	docker-compose stop
up:
	docker-compose up -d
composer-update:
	docker exec simple-shop bash -c "composer update"
data:
	docker exec simple-shop bash -c "php artisan migrate"
	docker exec simple-shop bash -c "php artisan db:seed"
