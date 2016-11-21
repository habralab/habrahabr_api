<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\Exception\IncorrectUsageException;

/**
 * Class PollResource
 *
 * Ресурс работы с опросами
 *
 * @package Habrahabr\Api\Resources
 * @version 0.1.5
 * @author  thematicmedia <info@tmtm.ru>
 * @link    https://tmtm.ru/
 * @link    https://habrahabr.ru/
 * @link    https://github.com/thematicmedia/habrahabr_api
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class PollResource extends AbstractResource implements ResourceInterface
{
    /**
     * Возвращает опрос по номеру
     *
     * @param int $poll_id Номер опроса
     * @return array
     * @throws IncorrectUsageException
     */
    public function getPoll($poll_id)
    {
        $this->checkId($poll_id);

        return $this->adapter->get(sprintf('/polls/%d', $poll_id));
    }

    /**
     * Голосование в опросе за один или несколько варинатов ответа
     *
     * Этот метод может быть предоставлен дополнительно, по запросу
     * https://habrahabr.ru/feedback/
     * 
     * @param int $poll_id Номер опроса
     * @param array|int $votes Номер или номера варинатов ответа
     *
     * @return mixed
     * @throws IncorrectUsageException
     */
    public function vote($poll_id, $votes = [])
    {
        $this->checkId($poll_id);

        if (!is_array($votes)) {
            $votes = [$votes];
        }

        array_map([$this, 'checkId'], $votes);

        return $this->adapter->put(sprintf('/polls/%d/vote', $poll_id), ['id' => $votes]);
    }
}
