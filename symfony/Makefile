.PHONY: start-bdd
start-bdd:
	docker compose up -d postgres

.PHONY: start
start:
	docker compose up -d --build

.PHONY: stop
stop:
	docker compose down

restart: stop start

.PHONY: stop-bdd
stop-bdd:
	docker compose down postgres

.PHONY: clean
clean:
	docker compose down --remove-orphans -v

init-db:
	docker exec -it php-s-book-store sh -c "php bin/console doctrine:migr:migr -n"
	
.PHONY: install
install:
	docker compose run --rm -it php composer install
