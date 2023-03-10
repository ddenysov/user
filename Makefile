DC := docker-compose exec
APP := $(DC) user
SV := $(DC) user_supervisor

start:
	@docker-compose up -d

stop:
	@docker-compose down

restart: stop start

ssh:
	@$(APP) bash

ssh-sv:
	@$(SV) bash

test:
	@$(APP) bin/phpunit

test-db-drop:
	@$(APP) bin/console doctrine:database:drop --force --if-exists --env=test

test-db-create-db:
	@$(APP) bin/console doctrine:database:create --env=test

test-db-create-schema:
	@$(APP) bin/console doctrine:schema:create --env=test

test-env: test-db-drop test-db-create-db test-db-create-schema