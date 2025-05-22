start:
	docker compose -f docker-compose.yml up -d

stop:
	docker compose -f docker-compose.yml down
	
init-db:
	docker compose -f docker-compose.yml run artisan migrate && cd ./src && php artisan key:generate && rm -r ./public/storage &&  ln -s ../storage/app/public public/storage

install-deps:
	cd ./src && composer install --ignore-platform-reqs && npm i && npm run build
