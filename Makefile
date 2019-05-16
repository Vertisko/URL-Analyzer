.PHONY: prepare
.DEFAULT_GOAL := prepare

prepare:
	php composer.phar install
	cp .env.example .env
	php artisan key:generate


