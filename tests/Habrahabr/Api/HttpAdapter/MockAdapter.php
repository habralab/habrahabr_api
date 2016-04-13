<?php

namespace Habrahabr\Api\HttpAdapter;

/**
 * Адаптер, используемый для проведения Unit-тестов.
 *
 * @author kafeman <kafemanw@gmail.com>
 *
 * @internal
 */
class MockAdapter implements HttpAdapterInterface
{
    use traitAdapter;

    /**
     * @var array
     */
    protected $routes;

    /**
     * Имитирует выполнение GET-запроса к серверу.
     *
     * @param string $url URL запрашиваемого ресурса
     *
     * @return mixed Результат запроса
     */
    public function get($url)
    {
        return $this->request($url, 'GET');
    }

    /**
     * Имитирует выполнение POST-запроса к серверу.
     *
     * @param string $url URL запрашиваемого ресурса
     * @param array $values Параметры, передаваемые в теле запроса
     *
     * @return mixed Результат запроса
     */
    public function post($url, array $values = [])
    {
        return $this->request($url, 'POST', $values);
    }

    /**
     * Имитирует выполнение DELETE-запроса к серверу.
     *
     * @param string $url URL запрашиваемого ресурса
     * @param array $values Параметры, передаваемые в теле запроса
     *
     * @return mixed Результат запроса
     */
    public function delete($url, array $values = [])
    {
        return $this->request($url, 'DELETE', $values);
    }

    /**
     * Имитирует выполнение PUT-запроса к серверу.
     *
     * @param string $url URL запрашиваемого ресурса
     * @param array $values Параметры, передаваемые в теле запроса
     *
     * @return mixed Результат запроса
     */
    public function put($url, array $values = [])
    {
        return $this->request($url, 'PUT', $values);
    }

    /**
     * Добавляет GET-ресурс с отдаваемыми назад данными.
     *
     * @param string $url URL запрашиваемого ресурса
     * @param mixed $data Возвращаемый ответ
     */
    public function addGetHandler($url, $data)
    {
        $this->addHandler($url, $data, 'GET');
    }

    /**
     * Добавляет POST-ресурс с отдаваемыми назад данными.
     *
     * @param string $url URL запрашиваемого ресурса
     * @param mixed $data Возвращаемый ответ
     */
    public function addPostHandler($url, $data)
    {
        $this->addHandler($url, $data, 'POST');
    }

    /**
     * Добавляет DELETE-ресурс с отдаваемыми назад данными.
     *
     * @param string $url URL запрашиваемого ресурса
     * @param mixed $data Возвращаемый ответ
     */
    public function addDeleteHandler($url, $data)
    {
        $this->addHandler($url, $data, 'DELETE');
    }

    /**
     * Добавляет PUT-ресурс с отдаваемыми назад данными.
     *
     * @param string $url URL запрашиваемого ресурса
     * @param mixed $data Возвращаемый ответ
     */
    public function addPutHandler($url, $data)
    {
        $this->addHandler($url, $data, 'PUT');
    }

    /**
     * Добавляет ресурс с отдаваемыми назад данными.
     *
     * @param string $url URL запрашиваемого ресурса
     * @param mixed $data Возвращаемый ответ
     * @param string $method HTTP-метод, например, GET
     */
    protected function addHandler($url, $data, $method)
    {
        $key = $this->createKey($url, $method);
        $this->routes[$key] = $data;
    }

    /**
     * Имитирует выполнение запроса к серверу.
     *
     * @param string $url URL запрашиваемого ресурса
     * @param string $method HTTP-метод, например, GET
     * @param array $values Параметры, передаваемые в теле запроса
     *
     * @return mixed Результат запроса
     */
    protected function request($url, $method, array $values = [])
    {
        $key = $this->createKey($url, $method);

        if (array_key_exists($key, $this->routes)) {
            return $this->routes[$key];
        } else {
            // 404 Not Found
            return false;
        }
    }

    /**
     * Создает уникальный ключ для массива маршрутов.
     *
     * Для одинаковых пар url/method создаваемые ключи всегда будут
     * одинаковыми, поэтому метод можно использовать как при добавлении,
     * так и при извлечении данных.
     *
     * @param string $url URL запрашиваемого ресурса
     * @param string $method HTTP-метод, например, GET
     *
     * @return string Уникальный ключ
     */
    protected function createKey($url, $method)
    {
        $key = $method . $url;
        return $key;
    }
}
