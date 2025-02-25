setup:
	@make build
	@make up
	@make composer-update
build:
	docker compose build --no-cache --force-rm
stop:
	docker compose stop
up:
	docker compose up -d
enter:
	docker exec -it of-backend-app-1 bash
cache:
	docker exec of-backend-app-1 bash -c "php artisan config:cache && php artisan route:cache && php artisan view:cache"
composer-update:
	docker exec of-backend-app-1 bash -c "export COMPOSER_ALLOW_SUPERUSER=1 && composer install"
data:
	docker exec of-backend-app-1 bash -c "chmod -R 777 storage"
	docker exec of-backend-app-1 bash -c "chmod -R 777 bootstrap"
	docker exec of-backend-app-1 bash -c "php artisan key:generate"
	docker exec of-backend-app-1 bash -c "php artisan storage:link"
	docker exec of-backend-app-1 bash -c "php artisan migrate"
	docker exec of-backend-app-1 bash -c "php artisan db:seed"
build-front:
	docker exec of-backend-app-1 bash -c "npm install && npm run build"
lint:
	make composer-update && docker exec of-backend-app-1 bash -c "./vendor/bin/pint --preset per"
refactor:
	make composer-update && docker exec of-backend-app-1 bash -c "./vendor/bin/rector"
deploy:
	make composer-update && make build-front && docker exec of-backend-app-1 bash -c "php artisan migrate && php artisan storage:link && php artisan optimize:clear && php artisan optimize"
test:
	docker exec of-backend-app-1 bash -c "php artisan test"