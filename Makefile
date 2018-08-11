# Makefile for project.

# Shell colors.
RED=\033[0;31m
LIGHT_RED=\033[1;31m
GREEN=\033[0;32m
LIGHT_GREEN=\033[1;32m
ORANGE=\033[0;33m
YELLOW=\033[1;33m
BLUE=\033[0;34m
LIGHT_BLUE=\033[1;34m
PURPLE=\033[0;35m
LIGHT_PURPLE=\033[1;35m
CYAN=\033[0;36m
LIGHT_CYAN=\033[1;36m
NC=\033[0m

help:
	@echo "\n${ORANGE}usage: make ${BLUE}COMMAND${NC}"
	@echo "\n${YELLOW}Commands:${NC}"
	@echo "  ${BLUE}c-install             : ${LIGHT_BLUE}Install PHP/Project dependencies with composer.${NC}"
	@echo "  ${BLUE}docker-start          : ${LIGHT_BLUE}Create and start containers.${NC}"
	@echo "  ${BLUE}docker-stop           : ${LIGHT_BLUE}Stop and clear all services.${NC}"
	@echo "  ${BLUE}logs                  : ${LIGHT_BLUE}Follow log output.${NC}"

c-install:
	@echo "${BLUE}Installing your application dependencies:${NC}"
	@docker-compose exec -T php composer install

import-db-project:
	cat app1/docker/sql/dump/chat_app.sql | docker-compose exec -T db psql -U chat chat_app

docker-start:
	@echo "${BLUE}Starting all containers:${NC}"
	@docker-compose up -d

docker-stop:
	@echo "${BLUE}Stopping all containers:${NC}"
	@docker-compose down -v

logs:
	@docker-compose logs -f

.PHONY: test
