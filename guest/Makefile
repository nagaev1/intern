start:
	docker compose -f docker-compose.yml up -d

stop:
	docker compose -f docker-compose.yml down

init-db:
	docker compose -f docker-compose.yml run artisan migrate && php src/artisan key:generate