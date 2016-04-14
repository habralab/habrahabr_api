<?php

namespace Habrahabr\Tests\Api\HttpAdapter;

use Habrahabr\Api\HttpAdapter\BaseAdapter;
use Habrahabr\Api\HttpAdapter\HttpAdapterInterface;

/**
 * Class MockAdapter
 *
 * Mock HTTP адаптер использующийся тестирования,
 * имитирует запросы и ответы Habrahabr Api HTTP
 *
 * @package Habrahabr\Tests\Api\HttpAdapter
 * @version 0.0.8
 * @author thematicmedia <info@tmtm.ru>
 * @link https://tmtm.ru/
 * @link https://habrahabr.ru/
 * @link https://github.com/thematicmedia/habrahabr_api
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class MockAdapter extends BaseAdapter implements HttpAdapterInterface
{
    /**
     * @var array Список предустановленых ответов на HTTP запросы
     */
    protected $routes = [];

    /**
     * Имитирует выполнение GET-запроса к серверу
     *
     * @param string $url URL суффикс запрашиваемого ресурса
     * @return mixed
     */
    public function get($url)
    {
        return $this->request($url, 'GET');
    }

    /**
     * Имитирует выполнение POST-запроса к серверу
     *
     * @param string $url URL суффикс запрашиваемого ресурса
     * @param array $params Параметры, передаваемые в теле запроса
     * @return mixed Результат запроса
     */
    public function post($url, array $params = [])
    {
        return $this->request($url, 'POST', $params);
    }

    /**
     * Имитирует выполнение PUT-запроса к серверу.
     *
     * @param string $url URL суффикс запрашиваемого ресурса
     * @param array $params Параметры, передаваемые в теле запроса
     * @return mixed Результат запроса
     */
    public function put($url, array $params = [])
    {
        return $this->request($url, 'PUT', $params);
    }

    /**
     * Имитирует выполнение DELETE-запроса к серверу.
     *
     * @param string $url URL суффикс запрашиваемого ресурса
     * @param array $params Параметры, передаваемые в теле запроса
     * @return mixed Результат запроса
     */
    public function delete($url, array $params = [])
    {
        return $this->request($url, 'DELETE', $params);
    }

    /**
     * Добавляет GET-ресурс в список предустановленых ответов
     *
     * @param string $url URL суффикс запрашиваемого ресурса
     * @param mixed $data Возвращаемый ответ
     */
    public function addGetHandler($url, $data)
    {
        $this->addHandler($url, $data, 'GET');
    }

    /**
     * Добавляет POST-ресурс в список предустановленых ответов
     *
     * @param string $url URL суффикс запрашиваемого ресурса
     * @param mixed $data Возвращаемый ответ
     */
    public function addPostHandler($url, $data)
    {
        $this->addHandler($url, $data, 'POST');
    }

    /**
     * Добавляет PUT-ресурс в список предустановленых ответов
     *
     * @param string $url URL суффикс запрашиваемого ресурса
     * @param mixed $data Возвращаемый ответ
     */
    public function addPutHandler($url, $data)
    {
        $this->addHandler($url, $data, 'PUT');
    }

    /**
     * Добавляет DELETE-ресурс в список предустановленых ответов
     *
     * @param string $url URL суффикс запрашиваемого ресурса
     * @param mixed $data Возвращаемый ответ
     */
    public function addDeleteHandler($url, $data)
    {
        $this->addHandler($url, $data, 'DELETE');
    }

    /**
     * Добавляет ресурс в список предустановленых ответов
     *
     * @param string $url URL суффикс запрашиваемого ресурса
     * @param mixed $data Возвращаемый ответ
     * @param string $method HTTP-метод, например, GET
     */
    protected function addHandler($url, $data, $method)
    {
        $key = $this->createKey($url, $method);
        $this->routes[$key] = $data;
    }

    /**
     * Имитирует выполнение запроса к серверу
     * возвращает ответ из списока предустановленых ответов
     *
     * @param string $url URL суффикс запрашиваемого ресурса
     * @param string $method метод HTTP запроса
     * @param array $params Параметры, передаваемые в теле запроса
     * @return mixed
     * @throws \Exception
     */
    protected function request($url, $method, array $params = [])
    {
        $key = $this->createKey($url, $method);

        if (array_key_exists($key, $this->routes)) {
            return $this->routes[$key];
        } else {
            throw new \Exception('Fake responce not found');
        }
    }

    /**
     * Уникальный ключ для кеширования предустановленного ответа
     *
     * @param string $url URL суффикс запрашиваемого ресурса
     * @param string $method метод HTTP запроса
     * @return string
     */
    protected function createKey($url, $method)
    {
        $key = $method . $url;
        return $key;
    }
}
