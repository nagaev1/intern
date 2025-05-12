start:
	docker compose -f docker-compose.yml up -d

stop:
	docker compose -f docker-compose.yml down
	
init-db:
	docker compose -f docker-compose.yml run artisan migrate && php artisan key:generate

install-deps: composer install --ignore-platform-reqs && npm i && npm run build