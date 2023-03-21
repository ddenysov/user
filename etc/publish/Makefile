DC := docker-compose exec
APP := $(DC) deploy

ssh:
	@$(APP) bash

start:
	@docker-compose up -d

stop:
	@docker-compose down

build-image-app:
	docker build app --tag ghcr.io/ddenysov/user:latest --build-arg CACHEBUST=$$RANDOM

push-image-app:
	docker push ghcr.io/ddenysov/user:latest

build-image-supervisor:
	docker build supervisor --tag ghcr.io/ddenysov/user-supervisor:latest --build-arg CACHEBUST=$$RANDOM

push-image-supervisor:
	docker push ghcr.io/ddenysov/user-supervisor:latest

remove-untagged:
	docker rmi $$(docker images -f dangling=true -q)

build: build-image-app push-image-app build-image-supervisor push-image-supervisor remove-untagged