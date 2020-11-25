curl -JOL https://clue.engineering/phar-composer-latest.phar
php -d phar.readonly=off phar-composer-1.1.0.phar build labo86/db_utils:dev-master