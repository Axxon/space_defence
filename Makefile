DOCKER_COMPOSE = docker-compose
EXEC_PHP = $(DOCKER_COMPOSE) exec -T php entrypoint
COMPOSER = $(EXEC_PHP) composer

core.kill:
	$(DOCKER_COMPOSE) kill
	$(DOCKER_COMPOSE) down --volumes --remove-orphans

core.clean: core.kill
	rm -rf .env vendor var/cache/* var/log/*

core.install: core.clean core.config.env core.build core.start core-sources.install

core.config.env: .env.dist
	@if [ -f .env ]; \
	then\
		echo '\033[1;41m/!\ The .env.dist file has changed. Please check your .env file (this message will not be displayed again).\033[0m';\
		touch .env;\
		exit 1;\
	else\
		echo cp .env.dist .env;\
		cp .env.dist .env;\
	fi

core.build:
	$(DOCKER_COMPOSE) pull --quiet --ignore-pull-failures 2> /dev/null
	$(DOCKER_COMPOSE) --verbose build --pull

core.start:
	$(DOCKER_COMPOSE) up -d --remove-orphans

core.stop:
	$(DOCKER_COMPOSE) down

# Sources

core-sources.save_current_dependencies_exact_versions: composer.json
	$(COMPOSER) update --lock --no-scripts --no-interaction
	@touch composer.lock

core-sources.install: core-sources.save_current_dependencies_exact_versions
	$(COMPOSER) install --dev
	@touch vendor

# Tests

core.tests: vendor
	$(EXEC_PHP) bin/phpunit --configuration phpunit.xml

# App cache
core-cache.clear:
	$(PROJECT) ca:cl

# tools
.PHONY: core.console

core.console args:
	$(PROJECT) $(args)
