<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\Exception\IncorrectUsageException;

/**
 * Class SettingsResource
 *
 * Ресурс работы с настройками профиля
 *
 * @package Habrahabr\Api\Resources
 * @version 0.1.3
 * @author thematicmedia <info@tmtm.ru>
 * @link https://tmtm.ru/
 * @link https://habrahabr.ru/
 * @link https://github.com/thematicmedia/habrahabr_api
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class SettingsResource extends AbstractResource implements ResourceInterface
{
    /**
     * Принять соглашение
     *
     * @return array
     */
    public function acceptAgreement()
    {
        return $this->adapter->put('/settings/agreement');
    }
}
