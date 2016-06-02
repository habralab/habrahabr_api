# Habrahabr Api Client

[![Build Status](https://travis-ci.org/thematicmedia/habrahabr_api.svg?branch=master)](https://travis-ci.org/thematicmedia/habrahabr_api)
[![Latest Stable Version](https://poser.pugx.org/tmtm/habrahabr_api/version)](https://packagist.org/packages/tmtm/habrahabr_api)
[![License](https://poser.pugx.org/tmtm/habrahabr_api/license)](https://packagist.org/packages/tmtm/habrahabr_api)
[![Code Coverage](https://scrutinizer-ci.com/g/thematicmedia/habrahabr_api/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/thematicmedia/habrahabr_api/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/thematicmedia/habrahabr_api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/thematicmedia/habrahabr_api/?branch=master)

Хабрахабр - самое крупное в Рунете сообщество людей, занятых в индустрии высоких
технологий. Уникальная аудитория, свежая информация, конструктивное общение и
коллективное творчество - всё это делает Хабрахабр самым оригинальным
IT-проектом в России.

## Установка

### Через composer:

```bash
$ composer require tmtm/habrahabr_api
```

или добавить

```json
"tmtm/habrahabr_api": "0.1.*"
```

в секцию `require` файла composer.json.

## Быстрый старт

Перед началом работы с API Хабрахабра потребуется пройти несколько несложных
этапов.

1. **Получение идентификатора приложения**

   Воспользовавшись [этой формой](https://habrahabr.ru/feedback/) на
   Хабрахабре, нужно кратко описать суть нового приложения и цель, для которой
   ему нужен API.

   Через некоторое время будет получен идентификатор и секрет нового приложения.
   *Держите секрет в секрете и никому его не давайте!*

2. **Получение токена пользователя**

   Каждое приложение может работать с API Хабра только от имени установившего
   его пользователя.

   Для получения токена можно воспользоваться следующим простым способом.
   Перейдите по следующей ссылке

       https://habrahabr.ru/auth/o/login/?client_id=КЛИЕНТ&response_type=token&redirect_uri=САЙТ

   поставив адрес сайта приложения вместо `САЙТ` и полученный на первом шаге
   идентификатор вместо `КЛИЕНТ`.

   После нажатия кнопки "Разрешить", Хабр выполнит перенаправление на `САЙТ`,
   добавив в конец адреса строку `#token=...`, которая и будет содержать
   требуемый токен.

3. **Создание тестового приложения**

   Дошедший до этого шага ужее имеет всю мощь API Хабрахабра. Теперь самое время
   воспользоваться библиотеку. Для начала инициализируем адаптер:

    ```php
    $adapter = new \Habrahabr\Api\HttpAdapter\CurlAdapter();
    $adapter->setEndpoint('API_ENDPOINT');
    $adapter->setToken('OAUTH_TOKEN');
    $adapter->setClient('OAUTH_CLIENT');
    ```

    ```php
    $client = new Habrahabr\Api\Client($adapter);
    # Доступ к ресурсу может быть получен через метод состоящий из `get` и названия ресурса
    $User = $client->getUserResource()->getUser('me');
    ```

## Описание API ресурсов и методы

- `CommentsResource` - Ресурс работы с комментариями

    * `getCommentsForPost($post_id)` - Возвращает список комментариев к посту по номеру
    * `postComment($post_id, $text, $comment_id = 0)` - Добавление комментария к посту по номеру
    * `votePlus($comment_id)` - Положительное голосование за комментарий
    * `voteMinus($comment_id)` - Отрицательное голосование за комментарий

- `CompanyResource` - Ресурс работы с компаниями

    * `getCompanyPosts($alias, $page = 1)` - Возвращает посты компании по алиасу компании
    * `getCompanyInfo($alias)` - Возвращает профиль компании по алиасу компании
    * `getList($page = 1)` - Возвращает список компаний

- `FeedResource` - Ресурс работы с "основной" лентой постов

    * `getFeedHabred($page = 1)` - Возвращает "Захабренные" посты из "основной" лентой постов
    * `getFeedUnhabred($page = 1)` - Возвращает "Отхабренные" посты из "основной" лентой постов
    * `getFeedNew($page = 1)` - Возвращает "Новые" посты из "основной" лентой постов

- `FlowResource` - Ресурс работы с потоками

    * `getFlows()` - Возвращает список потоков
    * `getFeedInteresting($alias, $page = 1)` - Возвращает "Интересные" посты из потока
    * `getFeedAll($alias, $page = 1)` - Возвращает "Все" посты посты из потока
    * `getFeedBest($alias, $page = 1)` - Возвращает "Лучшие" посты из потока

- `HubResource` - Ресурс работы с хабами

    * `getHubInfo($alias)` - Возвращает информацию о хабе по алиасу
    * `getFeedHabred($alias, $page = 1)` - Возвращает "Захабренные" посты связаные с хабом
    * `getFeedUnhabred($alias, $page = 1)` - Возвращает "Отхабренные" посты связаные с хабом
    * `getFeedNew($alias, $page = 1)` - Возвращает "Новые" посты связаные с хабом
    * `getHubList($page = 1)` - Возвращает список хабов
    * `subscribeHub($alias)` - Подписаться на хаб
    * `unsubscribeHub($alias)` - Отписаться от хаба

- `PostResource` - Ресурс работы с постами

    * `getPost($post_id)` - Возвращает пост по номеру
    * `votePlus($post_id)` - Положительное голосование за пост (*Этот метод может быть предоставлен дополнительно, по запросу*)
    * `voteMinus($post_id)` - Отрицательное голосование за пост (*Этот метод может быть предоставлен дополнительно, по запросу*)
    * `voteNeutral($post_id)` - Нейтральное голосование за пост (*Этот метод может быть предоставлен дополнительно, по запросу*)
    * `addPostToFavorite($post_id)` - Добавить пост в избранное
    * `removePostFromFavorite($post_id)` - Удалить пост из избранного

- `SearchResource` - Ресурс работы с поиском

    * `searchPosts($q, $page = 1)` - Поиск произвольного запроса по постам
    * `searchUsers($q, $page = 1)` - Поиск произвольного запроса по пользователям
    * `searchHubs($q)` - Поиск произвольного запроса по хабам

- `TrackerResource` - Ресурс работы с трекером

    * `push($title, $text)` - Отправить сообщение в трекер на вкладку "Приложения"
    * `getCounters()` - Возвращает счетчики новых сообщений из трекера, элементы не отмечаются как просмотренные
    * `getPostsFeed()` - Возвращает список постов из трекера,, элементы не отмечаются как просмотренные
    * `getSubscribersFeed()` - Возвращает список подписчиков из трекера, элементы не отмечаются как просмотренные
    * `getMentions()` - Возвращает список упоминаний из трекера, элементы не отмечаются как просмотренные
    * `getAppsFeed()` - Возвращает список сообщений приложений из трекера, элементы не отмечаются как просмотренные

- `UserResource` - Ресурс работы с пользователями

    * `getUserCurrent()` - Возвращает профиль пользователя API ключа
    * `getUser($login)` - Возвращает профиль пользователя по логину
    * `getUsersList()` - Возвращает список пользователей
    * `getUserComments($login, $page = 1)` - Возвращает комментарии пользователя по логину
    * `getUserPosts($login, $page = 1)` - Возвращает посты пользователя по логину
    * `getUserHubs($login)` - Возвращает хабы на которые подписан пользователь
    * `getUserCompanies($login)` - Возвращает компании в которых работает пользователь
    * `getUserFollowers($login, $page = 1)` - Возвращает список подписчиков пользователя по логину
    * `getUserFollowed($login, $page = 1)` - Возвращает список на кого подписан пользователь по логину
    * `voteKarmaPlus($login)` - Плюсовать карму пользователя по логину (*Этот метод может быть предоставлен дополнительно, по запросу*)
    * `voteKarmaMinus($login)` - Минусовать карму пользователя по логину (*Этот метод может быть предоставлен дополнительно, по запросу*)
    * `getUserFavoritesPost($login, $page = 1)` - Возвращает список "избранных" постов пользователя по логину
    * `getUserFavoritesComments($login, $page = 1)` - Возвращает список "избранных" комментариев пользователя по логину

## Тестирование

Для начала установить `--dev` зависимости. После чего запустить:

```bash
$ vendor/bin/phpunit
```

Для проведения тестирования на рабочем API, необходимо скопировать файл `phpunit.xml.dist` в `phpunit.xml`
И добавить в него секцию содержащую ключи для работы с API:

```bash
<php>
    <env name="ENDPOINT" value="https://api.habrahabr.ru/v1"/>
    <env name="TOKEN" value="ВАШ_OAUTH_TOKEN"/>
    <env name="CLIENT" value="ВАШ_OAUTH_CLIENT"/>
</php>
```

## Лицензия

Библиотека доступна на условиях лицензии MIT: http://www.opensource.org/licenses/mit-license.php

## Реализации на других языках:

* Python: [habrahabr-python](https://github.com/kafeman/habrahabr-python)
