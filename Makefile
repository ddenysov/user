DC := docker-compose exec
DC_SYNC := CURRENT_USER=${CURRENT_ID}:${CURRENT_GROUP} docker-compose --file docker-compose-sync.yml
APP := $(DC) user
SV := $(DC) user_supervisor
NODE := $(DC) node yarn
ARTISAN := $(FPM) php artisan
MYSQL := $(DC) -T mysql
CURRENT_UID := $(shell id -u)
OS := $(shell uname)

start:
	@docker-compose up -d

stop:
	@docker-compose stop

restart: stop start

ssh:
	@$(APP) bash

test:
	@$(APP) bin/phpunit

test-db-drop:
	@$(APP) bin/console doctrine:database:drop --force --if-exists --env=test

test-db-create-db:
	@$(APP) bin/console doctrine:database:create --env=test

test-db-create-schema:
	@$(APP) bin/console doctrine:schema:create --env=test

test-env: test-db-drop test-db-create-db test-db-create-schema