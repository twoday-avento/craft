.PHONY: help install dev build up stop ssh craft composer npm update lint format clean

help: ## Show this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-15s\033[0m %s\n", $$1, $$2}'

install: ## Full project setup (start DDEV, install deps, install Craft)
	ddev start
	ddev composer install
	ddev npm install
	@if [ ! -f .env ]; then cp .env.example .env; fi
	ddev craft install
	ddev craft plugin/install ckeditor
	ddev craft plugin/install seomatic
	ddev craft plugin/install imager-x
	ddev craft plugin/install hyper
	ddev craft plugin/install vite
	@echo "\n✅ Project ready! Run 'make dev' to start developing."

dev: ## Start Vite dev server
	ddev npm run dev

build: ## Build frontend for production
	ddev npm run build

up: ## Start DDEV and run any pending migrations
	ddev start
	ddev craft up

stop: ## Stop DDEV
	ddev stop

ssh: ## SSH into the web container
	ddev ssh

craft: ## Run a Craft CLI command (usage: make craft CMD="migrate")
	ddev craft $(CMD)

composer: ## Run a Composer command (usage: make composer CMD="require foo/bar")
	ddev composer $(CMD)

npm: ## Run an npm command (usage: make npm CMD="install foo")
	ddev npm $(CMD)

update: ## Update all Composer and npm dependencies
	ddev composer update
	ddev npm update
	ddev craft up

lint: ## Run ESLint and Prettier checks
	ddev npm run lint
	ddev npm run format:check

format: ## Auto-format Twig, CSS, and JS files
	ddev npm run format
	ddev npm run lint:fix

clean: ## Remove generated files (vendor, node_modules, dist)
	rm -rf vendor node_modules web/dist
