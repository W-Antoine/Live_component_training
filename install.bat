@echo off
echo Installing PHP dependencies...
composer install

echo Installing JS dependencies...
npm install

echo Building assets...
npm run build

echo Clearing cache...
php bin/console cache:clear

echo Done! Run start.bat to launch the dev server.
