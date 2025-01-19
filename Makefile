DOCKER_COMPOSE = ./vendor/bin/sail
ARTISAN = $(DOCKER_COMPOSE) artisan

up:
	$(DOCKER_COMPOSE) up -d

down:
	$(DOCKER_COMPOSE) down

restart:
	$(DOCKER_COMPOSE) down && $(DOCKER_COMPOSE) up -d

migrate:
	$(ARTISAN) migrate --force

seed:
	$(ARTISAN) db:seed --force

migrate-seed:
	$(ARTISAN) migrate --force && $(ARTISAN) db:seed --force

migrate-fresh:
	$(ARTISAN) migrate:fresh --force

clear-cache:
	$(ARTISAN) cache:clear && $(ARTISAN) config:clear && $(ARTISAN) route:clear && $(ARTISAN) view:clear

swagger-generate:
	$(ARTISAN) l5-swagger:generate