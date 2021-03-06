# Что такое? #
База для новых проектов. Symfony 3.4.

## Приступая к работе

На проекте используется Continuous Integration и Continuous Deployment

Исходники frontend расположены в директории ./frontend/ изучите ./frontend/README.md

## Известные хосты, ветки окружения, CI+CD

| Окружение | Git branch  | Автодеплой | Хост |
|-----------|------------ |------------|------------|
| prod      | master      | нет        | 
| stag      | stag        | нет        | 
| demo1     | dev         | нет        | 

Проект Codeship:

https://app.codeship.com/projects/252757

## Схема ветвления git

**Минимальная:**

1. master -> task_1234567_extra_alias
2. master <- pr <- task_1234567_extra_alias

**Задача из task tracker + демонстрация на тестовом**

1. master -> task_1234567_extra_alias _(начало работы над задачей)_
2. dev <- pr <- task_1234567_extra_alias _(демонстрация функционала на тестовом хосте)_
3. master <- pr <- task_1234567_extra_alias _(деплой на боевой)_

**Задача из task tracker + демонстрация на тестовом + демонстрация на staging**

1. master -> task_1234567_extra_alias _(начало работы над задачей)_
2. dev <- pr <- task_1234567_extra_alias _(демонстрация функционала на тестовом хосте)_
3. stag <- pr <- task_1234567_extra_alias _(предрелизный показ)_
4. master <- pr <- stag _(деплой на боевой)_

# Что там есть? #


### [Common Bundle](https://bitbucket.org/prodhub/common-bundle/overview)
Общие вещи для наших решений.

### [Sonata](https://sonata-project.org/) ###
Почти вся семейка сонаты.

### [Nelmio CORS Bundle](https://github.com/nelmio/NelmioCorsBundle) ###
Поддерживает все фичи CORS. В общем случае используется для разрешения кроссдоменных запросов фронтам во время разработки.

### [Nelmio Api Doc Bundle](https://github.com/nelmio/NelmioApiDocBundle) ###
Генерация документации к методам на основе аннотаций.

### [FOS JS Routing Bundle](https://github.com/FriendsOfSymfony/FOSJsRoutingBundle) ###
Позволяет использовать роутинг в JS. Нельзя хардкодить пути к методам в js.

### [ADW Js Context Bundle](https://bitbucket.org/prodhub/js-context-bundle) ###
Вывод данных в контекст js.

### [ADW Geo Bundle](https://bitbucket.org/prodhub/adw-geoip-bundle) ###
Geo Ip БД.

### [ADW SEO Bundle](https://bitbucket.org/prodhub/seo-bundle) ###
Настройки метаданных страниц и редиректов в админке.

Еще много чего. В этом разделе описывать не предназначение каждого бандла, а описывать почему он нужен именно в скелетоне и специфику его использования в скелетоне (если это не очевидно).
***
# Логирование #
Для логов по умолчанию настроена ротация. 

Добавлен канал "domain" с уровнем info, в него рекомендуется логировать доменные события.
```
#!php
$container->get('monolog.logger.domain')->info('User registered ...');
```
Добавлен handler "external" - раскомментировать и настроить каналы если используются удаленные сервисы (CRM, например).

Расширенный вариант rollbar handler'а:

```
#!yaml
adw_common:
    logger:
        rollbar:
            token: ...
#           person_provider: my_awesome_person_provider #Можно указать кастомный провайдер данных пользователя

monolog:
    handlers:
        rollbar:
        type: rollbar
        id: common.logger.rollbar
        level: critical
```
В config_prod.yml все это есть, нужно только раскомментировать.

***
# Админка #
Админка доступна по адресу /admin

Создание администратора bin/console adw:create:admin username password
***
# Установка и запуск #
1. Форкнуть этот репозиторий, создав репозиторий для проекта в команде prodhub.

***
# Код стайл #
Для приведения кода в нормальный вид выполнить:

```
#!bash

bin/php-cs-fixer fix src --rules=@Symfony
```

***

# Развитие скелетона #
Цели разработки и использования скелетона:

* Максимально быстрая инициализация нового проекта
* Общая архитектура проектов
* Навязывание определенных общих подходов и стиля

Это должно способствовать повышению скорости и качества разработки, а так же облегчить поддержку.

Скелетон должен стать базой для всех новых проектов. 

Развивать проект можно отправкой pull request с форкнутых проектов. (Напрямую коммитить если если уверенность что оно нужно и ничего не сломает)
***
### TODO ###
* Больше доки. Вместо одного readme сделать папку docs с докой по категориям.



