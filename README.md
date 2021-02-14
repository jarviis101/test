# Test

## Установка

Приложение требует: 
* [PHP 7.4](https://www.php.net/)
* [MariaDB 10.5](https://mariadb.org/)
* [Composer](https://getcomposer.org/)

### Если Вы не используете Docker:
```sh
$ git clone https://github.com/jarviis101/test.git
$ cd test
$ cp .env.example .env
$ composer install
$ php artisan key:generate
Заполните оставшиеся переменные .env файла
$ php artisan jwt:secret
$ php artisan migrate --seed
$ php artisan serve
```
После этих манипуляций, этот проект запуститься по URL-адресу указанному из .env файла. 
По-умолчанию: http://localhost

### Если Вы используете Docker:
```sh
$ git clone https://github.com/jarviis101/test.git
$ cd test
$ cp .env.example .env
$ docker run --rm -v $(pwd):/app composer install
$ sudo chown -R $USER:$USER .
Допишите строку в файле /etc/hosts (без кавычек): "127.0.0.1 test.loc db.test.loc"
$ docker-compose build
$ docker-compose up -d
$ docker exec app_test php artisan key:generate
$ docker exec app_test php artisan jwt:secret
$ docker exec app_test php artisan migrate --seed
```

После запуска, можете проверить статус запущенных контейнеров:
```sh
$ docker-compose ps
```

Если запуск был произведен успешно и Вы дописали строку в файле /etc/hosts:
* Сайт: http://test.loc/
* База данных: http://db.test.loc/
* Swagger Api Doc: http://test.loc/api/documentation
  

#### Для запуска каких-либо команд консоли необходимо набрать команду в таком формате:
```sh
$ docker exec app_test php artisan config:cache
```

#### Для альтернативного способа запуска команд:
```sh
$ docker exec -it app_test bash
```
После запуска вы перейдете в консоль и сможете спокойно выполнять команды. Например:
```sh
$ php artisan migrate
```

#### Команда для запуска линтера:
```sh
$ ./vendor/bin/phpcs
```
