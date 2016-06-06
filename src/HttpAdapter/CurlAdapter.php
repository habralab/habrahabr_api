<?php

namespace Habrahabr\Api\HttpAdapter;

use Habrahabr\Api\Exception\ExtensionNotLoadedException;
use Habrahabr\Api\Exception\NetworkException;

/**
 * Class CurlAdapter
 *
 * Habrahabr Api HTTP адаптер использующий cURL как транспорт
 *
 * @package Habrahabr\Api\HttpAdapter
 * @version 0.1.2
 * @author thematicmedia <info@tmtm.ru>
 * @link https://tmtm.ru/
 * @link https://habrahabr.ru/
 * @link https://github.com/thematicmedia/habrahabr_api
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class CurlAdapter extends BaseAdapter implements HttpAdapterInterface
{
    /**
     * @const string Тип HTTP запроса GET
     */
    const METHOD_GET = 'GET';

    /**
     * @const string Тип HTTP запроса POST
     */
    const METHOD_POST = 'POST';

    /**
     * @const string Тип HTTP запроса PUT
     */
    const METHOD_PUT = 'PUT';

    /**
     * @const string Тип HTTP запроса DELETE
     */
    const METHOD_DELETE = 'DELETE';

    /**
     * @var null|resource Экземпляр cURL
     */
    protected $curl = null;

    /**
     * @var bool Строгая проверка SSL сертификата
     */
    protected $strictSSL = true;

    /**
     * CurlAdapter constructor
     *
     * @throws ExtensionNotLoadedException
     */
    public function __construct()
    {
        if (!function_exists('curl_init')) {
            throw new ExtensionNotLoadedException('The cURL PHP extension was not loaded');
        }

        $this->curl = curl_init();
    }

    /**
     * CurlAdapter destructor
     */
    public function __destruct()
    {
        if ($this->curl) {
            curl_close($this->curl);
        }
    }

    /**
     * Выполнить HTTP GET запрос и вернуть тело ответа
     *
     * @param string $url URL суффикс запрашиваемого ресурса
     * @return array
     * @throws NetworkException
     */
    public function get($url)
    {
        return $this->request($this->createUrl($url), self::METHOD_GET);
    }

    /**
     * Выполнить HTTP POST запрос и вернуть тело ответа
     *
     * @param string $url URL суффикс запрашиваемого ресурса
     * @param array $params Параметры, передаваемые в теле запроса
     * @return array
     * @throws NetworkException
     */
    public function post($url, array $params = [])
    {
        return $this->request($this->createUrl($url), self::METHOD_POST, $params);
    }

    /**
     * Выполнить HTTP PUT запрос и вернуть тело ответа
     *
     * @param string $url URL суффикс запрашиваемого ресурса
     * @param array $params Параметры, передаваемые в теле запроса
     * @return array
     * @throws NetworkException
     */
    public function put($url, array $params = [])
    {
        return $this->request($this->createUrl($url), self::METHOD_PUT, $params);
    }

    /**
     * Выполнить HTTP DELETE запрос и вернуть тело ответа
     *
     * @param string $url URL суффикс запрашиваемого ресурса
     * @param array $params Параметры, передаваемые в теле запроса
     * @return array
     * @throws NetworkException
     */
    public function delete($url, array $params = [])
    {
        return $this->request($this->createUrl($url), self::METHOD_DELETE, $params);
    }

    /**
     * Устанавливает или убирает строгую проверку SSL сертификата
     *
     * @param bool $flag Флаг строгой проверки SSL сертификата
     * @return $this
     */
    public function setStrictSSL($flag = true)
    {
        $this->strictSSL = $flag;

        return $this;
    }

    /**
     * Выполнить HTTP запрос и вернуть тело ответа
     *
     * @param string $url URL суффикс запрашиваемого ресурса
     * @param string $method метод HTTP запроса
     * @param array $params Параметры, передаваемые в теле запроса
     * @return array
     * @throws NetworkException
     */
    protected function request($url, $method, array $params = [])
    {
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, $this->connectionTimeout);

        if ($this->client !== null && $this->token !== null) {
            curl_setopt($this->curl, CURLOPT_HTTPHEADER, [
                'client: ' . $this->client,
                'token: ' . $this->token
            ]);
        } elseif ($this->apikey !== null) {
            curl_setopt($this->curl, CURLOPT_HTTPHEADER, [
                'apikey: ' . $this->apikey,
            ]);
        }

        if ($this->strictSSL === false) {
            curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, 0);
        }

        if ($method == self::METHOD_PUT || $method == self::METHOD_POST) {
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($params));
        }

        if (!$result = curl_exec($this->curl)) {
            $error = curl_error($this->curl);
            $errno = curl_errno($this->curl);
            throw new NetworkException($error, $errno);
        }

        $result = json_decode($result, true);

        return $result ? $result : [];
    }
}
