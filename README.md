# Habrahabr Api Client

[![Build Status](https://travis-ci.org/thematicmedia/habrahabr_api.svg?branch=master)](https://travis-ci.org/thematicmedia/habrahabr_api)
[![Latest Stable Version](https://poser.pugx.org/tmtm/habrahabr_api/version)](https://packagist.org/packages/tmtm/habrahabr_api)
[![License](https://poser.pugx.org/tmtm/habrahabr_api/license)](https://packagist.org/packages/tmtm/habrahabr_api)

Хабрахабр - самое крупное в Рунете сообщество людей, занятых в индустрии высоких
технологий. Уникальная аудитория, свежая информация, конструктивное общение и
коллективное творчество - всё это делает Хабрахабр самым оригинальным
IT-проектом в России.

## Установка

### Через composer:

```bash
$ composer require tmtm/habrahabr_api
```

## Быстрый старт

Перед началом работы с API Хабрахабра потребуется пройти несколько несложных
этапов.

1. **Получение идентификатора приложения**

   Воспользовавшись [этой формой](http://habrahabr.ru/feedback/?type=8) на
   Хабрахабре, нужно кратко описать суть нового приложения и цель, для которой
   ему нужен API.

   Через некоторое время будет получен идентификатор и секрет нового приложения.
   *Держите секрет в секрете и никому его не давайте!*

2. **Получение токена пользователя**

   Каждое приложение может работать с API Хабра только от имени установившего
   его пользователя.

   Для получения токена можно воспользоваться следующим простым способом.
   Перейдите по следующей ссылке

       https://auth.habrahabr.ru/o/login/?redirect_uri=САЙТ&response_type=token&client_id=КЛИЕНТ

   поставив адрес сайта приложения вместо `САЙТ` и полученный на первом шаге
   идентификатор вместо `КЛИЕНТ`.

   После нажатия кнопки "Разрешить", Хабр выполнит перенаправление на `САЙТ`,
   добавив в конец адреса строку `#token=...`, которая и будет содержать
   требуемый токен.

3. **Создание тестового приложения**

   Дошедший до этого шага ужее имеет всю мощь API Хабрахабра. Теперь самое время
   воспользоваться библиотеку. Для начала инициализируем ее:


    ```php
    $adapter = new \Habrahabr\Api\HttpAdapter\CurlAdapter();
    $adapter->setEndpoint('API_ENDPOINT');
    $adapter->setToken(getenv('OAUTH_TOKEN'));
    $adapter->setClient(getenv('OAUTH_CLIENT'));
    ```

## Доступне API ресурсы и методы

- `CommentsResource` - Ресурс работы с комментариями.

    * `getCommentsForPost($post_id)` - Возвращает список комментариев к посту по номеру
    * `postComment($post_id, $text, $comment_id = 0)` - Добавление комментария к посту по номеру
    * `votePlus($comment_id)` - Положительное голосование за комментарий
    * `voteMinus($comment_id)` - Отрицательное голосование за комментарий

## Тестирование

Для начала установить `--dev` зависимости. После чего запустить:

```bash
$ vendor/bin/phpunit
```

## Лицензия

Библиотека доступна на условиях лицензии MIT: http://www.opensource.org/licenses/mit-license.php

## Реализации на других языках:

* Python: [habrahabr-python](https://github.com/kafeman/habrahabr-python)
