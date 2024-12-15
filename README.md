<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px" />
    </a>
    <h1 align="center">Americor Credit - test task</h1>
    <br>
</p>



INSTALLATION
------------

```
docker-compose up -d
docker exec -it americor-credit-php-fpm php init --env=Development --overwrite=All --delete=All
docker exec -it americor-credit-php-fpm composer install
docker exec -it americor-credit-php-fpm php yii migrate --interactive=0
docker exec -it americor-credit-php-fpm php yii_test migrate --interactive=0
docker exec -it americor-credit-php-fpm php yii user/create admin@americor-credit.local 87h123mi9z1

To hosts file:

127.0.0.1 adm.americor-credit.local

Service will be available at http://adm.americor-credit.local:4000/

Also service will be available at http://localhost:4000/

Login: admin@americor-credit.local
Password: 87h123mi9z1

Create loan product, create client, in client grid push the button "loans" on any client

check queues:

docker exec -it americor-credit-php-fpm php /var/www/app/yii queue-email
docker exec -it americor-credit-php-fpm php /var/www/app/yii queue-sms

```

TESTS
------------

```
docker exec -it americor-credit-php-fpm ./vendor/bin/codecept run
```

STATIC ANALYZER
------------

```

docker exec -it americor-credit-php-fpm ./vendor/bin/psalm --no-cache

```
