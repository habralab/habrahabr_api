<?php

namespace Habrahabr\Api\HttpAdapter;

use HttpException;
use HttpRequest;
use Habrahabr\Api\Exception\ExtenstionNotLoadedException;

/**
 * Адаптер построенный на php модуле Http
 *
 * @see     http://www.php.net/manual/ru/book.http.php
 *
 * @package Habrahabr_api\HttpAdapter
 *
 * @deprecated
 *
 * HttpRequest это устаревшая версия pecl_http, нужно переписать под v2
 */
class HttpRequestAdapter implements HttpAdapterInterface
{
    use traitAdapter;

    public function __construct()
    {
        if (!class_exists('HttpRequest')) {
            throw new ExtenstionNotLoadedException('HttpRequest module not loaded');
        }
    }

    public function get($url)
    {
        return $this->request($this->createUrl($url), HttpRequest::METH_GET);
    }

    public function post($url, array $values = [])
    {
        return $this->request($this->createUrl($url), HttpRequest::METH_POST, $values);
    }

    public function delete($url)
    {
        return $this->request($this->createUrl($url), HttpRequest::METH_DELETE);
    }

    public function put($url, array $values = [])
    {
        return $this->request($this->createUrl($url), HttpRequest::METH_PUT, $values);
    }

    private function request($url, $method, array $values = [])
    {
        $req = new \HttpRequest($url, $method);

        $req->setHeaders(['client' => $this->client, 'token' => $this->token]);

        if ($method === HttpRequest::METH_PUT) {
            $req->addPutData(http_build_query($values));
            $req->setContentType('application/x-www-form-urlencoded');
        }

        try {
            $req->send();
            $res = $req->getResponseBody();

            // @todo разбор ошибок?
            return json_decode($res, true);
        } catch (HttpException $e) {
            return false;
        }
    }
}
