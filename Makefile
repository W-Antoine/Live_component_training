# Mac/Linux : make install && make dev
# Windows   : install.bat puis start.bat

.PHONY: install dev server watch

install:
	composer install
	npm install
	npm run build
	php bin/console cache:clear

dev: server watch

server:
	php -S localhost:8000 -t public &

watch:
	npm run watch