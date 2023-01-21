help: ## Show help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

start: ## Run application
	@echo Running application on http://127.0.0.1:8008
	@docker-compose up -d

stop:  ## Stop application and delete containers and volumes
	@echo Stoping application...
	@docker-compose down


db:  ## Run database
	@echo Running database...
	@echo Database: app
	@echo Host: db
	@echo User: app
	@docker-compose up db -d

adminer: db ## Run adminer
	@echo Running adminer on port http://127.0.0.1:8080
	@echo Database: app
	@echo Host: db
	@echo User: app
	@docker run -it --rm --net app --name adminer -p 8080:8080 -d adminer

migrate: start ## Run migrations
	@echo Run migrations
	@docker exec -it app php bin/console doctrine:migrations:migrate --no-interaction

logs:  ## Show logs
	@echo Show docker logs
	@docker-compose logs

logs-app:  ## Show logs for app container
	@echo Show docker logs for app container
	@docker-compose logs app

test: start ## Run tests
	@echo Run tests
	@docker exec app /app/vendor/bin/phpunit --testdox /app/tests