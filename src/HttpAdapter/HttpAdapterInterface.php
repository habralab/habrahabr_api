<?php

namespace Habrahabr\Api\HttpAdapter;

/**
 * Interface HttpAdapterInterface
 *
 * Базовый интерфейс для всех Habrahabr Api HTTP адаптеров
 *
 * @package Habrahabr\Api\HttpAdapter
 * @version 0.1.0
 * @author thematicmedia <info@tmtm.ru>
 * @link https://tmtm.ru/
 * @link https://habrahabr.ru/
 * @link https://github.com/thematicmedia/habrahabr_api
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
interface HttpAdapterInterface
{
    public function setToken($token);

    public function setClient($client);

    public function get($url);

    public function post($url, array $values = []);

    public function put($url, array $values = []);

    public function delete($url);
}
