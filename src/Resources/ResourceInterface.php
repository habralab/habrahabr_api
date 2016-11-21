<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\HttpAdapter\HttpAdapterInterface;

/**
 * Interface ResourceInterface
 *
 * Ресурс работы с поиском
 * Базовый интерфейс для всех Habrahabr Api ресурсов
 *
 * @package Habrahabr\Api\Resources
 * @version 0.1.5
 * @author thematicmedia <info@tmtm.ru>
 * @link https://tmtm.ru/
 * @link https://habrahabr.ru/
 * @link https://github.com/thematicmedia/habrahabr_api
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
interface ResourceInterface
{
    public function setAdapter(HttpAdapterInterface $adapter);
}
