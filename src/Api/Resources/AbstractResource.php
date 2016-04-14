<?php

namespace Habrahabr\Api\Resources;

use Habrahabr\Api\HttpAdapter\HttpAdapterInterface;

/**
 * Basic Resource class
 *
 * @package Habrahabr_api\Resources
 */
abstract class AbstractResource
{
    /**
     * @var HttpAdapterInterface
     */
    protected $adapter;

    /**
     * @param HttpAdapterInterface $adapter
     *
     * @return $this
     */
    public function setAdapter(HttpAdapterInterface $adapter)
    {
        $this->adapter = $adapter;

        return $this;
    }
}
