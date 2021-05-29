include .env

help: ## Help menu
	@echo "App Tasks"
	@cat $(MAKEFILE_LIST) | pcregrep -o -e "^([\w]*):\s?##(.*)"
	@echo

start: ## starts docker compose
	docker-compose --env-file .env -f ./docker/docker-compose.yml up

restart: ## starts docker compose
	docker-compose --env-file .env -f ./docker/docker-compose.yml restart

stop: ## stops all containers
	docker-compose --env-file .env -f ./docker/docker-compose.yml stop

ssh: ## connect to fpm container
	docker exec -it $(APP_NAME)-fpm ash

composer-optimized: ## runs an optimized no-dev composer install
	composer install --apcu-autoloader --optimize-autoloader

prod: ## ssh into prod server
	ssh $(PROD_SSH_URL) -p 7822 -t "cd $(PROD_PATH) ; bash"
