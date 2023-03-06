DC := docker-compose exec
DC_SYNC := CURRENT_USER=${CURRENT_ID}:${CURRENT_GROUP} docker-compose --file docker-compose-sync.yml
APP := $(DC) user
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