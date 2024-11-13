GIT := $(shell which git)
SUB_MAKE := $(shell which make)
RM := $(shell which rm)
DOCKER := $(shell which docker)
MKDIR := $(shell which mkdir)
DOCKER_COMPOSE := $(DOCKER) compose --env-file .env-compose
DOCKER_COMPOSE_RUN := $(DOCKER_COMPOSE) run --rm
DOCKER_EXEC_PHP := $(DOCKER) exec -it php-s-book-store
PHP := $(DOCKER_COMPOSE) run --rm php-s
USER_ID := $(shell id -u)
GROUP_ID := $(shell id -g)
TEST_REPORT_BASE_PATH := tests/reports

ENV ?= dev
APP_ENV ?= $(ENV)

## Add variable useful for docker like GUI and UID
.env-compose:
	@echo "UID=$(USER_ID)" > $@
	@echo "GID=$(GROUP_ID)" >> $@
	@echo "APP_ENV=$(APP_ENV)" >> $@

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

assets:
	$(SUB_MAKE) sc/'asset-map:compile'

.PHONY: install
install: .env-compose assets
	docker compose run --rm -it php composer install

######
CLI command:

## Run a command console through symfony CLI like `make sc/'c:c'`
sc/%: .env-compose
	$(PHP) bin/console $*

## Load fixtures
fixtures:
	# $(SUB_MAKE) sc/'hautelook:fixtures:load --purge-with-truncate -n'
	$(DOCKER_EXEC_PHP) bin/console hautelook:fixtures:load --purge-with-truncate -n

help:
	@awk '/^[a-zA-Z \-_0-9(\\u00a9|\\u00ae|[\\u2000-\\u3300]|\\ud83c[\\ud000-\\udfff]|\\ud83d[\\ud000-\\udfff]|\\ud83e[\\ud000-\\udfff])]+:/ { \
		helpMessage = match(lastLine, /^## (.*)/); \
		if (helpMessage) { \
			helpCommand = substr($$1, 0, index($$1, ":") - 1); helpMessage = substr(lastLine, RSTART + 3, RLENGTH); \
			printf "  ${YELLOW}%-$(TARGET_MAX_CHAR_NUM)s${RESET} ${GREEN}%s${RESET}\n", helpCommand, helpMessage; \
		} \
		isTopic = match(lastLine, /^###/); \
	    if (isTopic) { printf "\n%s\n", $$0; } \
	} { lastLine = $$0 }' $(MAKEFILE_LIST)

