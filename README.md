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
$ php artisan jwt:secret
Заполните оставшиеся переменные .env файла если таковые имеются
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
Если запуск был произведен успешно и Вы соблюдали все инструкции:
* Сайт: http://test.loc/
* База данных: http://db.test.loc/
* Api документация: http://test.loc/api/documentation

Для доступа к api эндпоинтам необходим JWT токен. 
Присутствует регистрация и авторизация. После авторизации вы получите ключ("access_token").
При клике по кнопке "Authorize" необходимо заполнить поле с ключом, записывать в поле 
только ключ без дополнительных строк.

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
#### Команда для запуска юнит тестов:
```sh
$ php artisan test
```
#### Команда для запуска линтера:
```sh
$ ./vendor/bin/phpcs
```
Запись логов происходит в файле storage/logs/laravel.log (Исключения не попадают в лог)

## Сущности:
### Лекарственное средство - модель Drug: 
Route: http://test.loc/drugs

Имеет поля: id, name, price, manufacturer_id, ingredient_id, timestamps;
  
Имеет 2 связи к моделям Manufacturer и Ingredient;
  
Присутствует CRUD-контроллер и API-контроллер;
  
Присутствуют тесты.

### Производитель - модель Manufacturer:
Route: http://test.loc/manufacturers

Имеет поля: id, name, link, timestamps;

Имеет 1 связь к модели Drug;

Присутствует CRUD-контроллер;

Присутствуют тесты.

### Действующее вещество - модель Ingredient:
Route: http://test.loc/ingredients

Имеет поля: id, name, timestamps;

Имеет 1 связи к модели Drug;

Присутствует CRUD-контроллер;

Присутствуют тесты.
